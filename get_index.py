import json
import os

retdic={"index":[]}
lisjs=os.listdir("threads")
for js in lisjs:
    with open("threads/"+js,"r") as f:
        j=json.load(f)
    retdic["index"].append(
        {
            "id":j["id"],
            "title":j["title"],
            "num_posts":len(j["posts"]),
            "datetime_last_post":j["posts"][-1]["datetime"]
        }
    )

with open("index.json","w") as f:
    json.dump(retdic,f,indent=4,ensure_ascii=False)