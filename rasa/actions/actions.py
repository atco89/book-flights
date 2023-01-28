import requests
import json

from typing import Any, Text, Dict, List

from rasa_sdk import Action, Tracker
from rasa_sdk.executor import CollectingDispatcher

uri = "http://webserver/public/api/flight"

class ActionSearchFlights(Action):

    def name(self) -> Text:
        return "action_search_flights"

    def run(self, dispatcher: CollectingDispatcher, tracker: Tracker, domain: Dict[Text, Any]) -> List[Dict[Text, Any]]:
        dispatcher.utter_message("Please wait while I'm searching for a flight ...")

        departure = next(tracker.get_latest_entity_values("departure"), None)
        arrival = next(tracker.get_latest_entity_values("arrival"), None)
        flights = requests.get(uri + "?departure=" + departure + "&arrival=" + arrival).json()

        carousel = {
          "type":"template",
          "payload":{
             "template_type":"generic",
             "elements":[]
          }
        }

        for flight in flights:
            carousel['payload']['elements'].append({
                "title": flight['flight_iata'] + " - " + flight['airline']['name'],
                "subtitle": flight['departure_airport']['name'] + " - " + flight['arrival_airport']['name'],
                "image_url": "http://localhost:8888/images/logo/" + flight['airline']['image_path'],
                "buttons": [
                    {
                        "title": "Book",
                        "url": flight['uid'],
                        "type": "web_url"
                    }
                ]
            })

        dispatcher.utter_message(text="We have found your flights", attachment=carousel)

        return []
