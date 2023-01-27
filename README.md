```
make start migrate seed
docker exec -it rasa bash
rasa train
rasa run actions
rasa run --enable-api --cors "*" --port 5010
```