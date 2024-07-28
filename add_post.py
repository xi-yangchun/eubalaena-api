import datetime
import json
import sys
args=sys.argv

thread_id=args[1]
name=args[2]
content=args[3]
postdt=datetime.datetime.now()
is_tripped=False
replies=[]

with open("threads/"+thread_id+".json","r") as f:
    thread=json.load(f)

num=len(thread["posts"])+1

thread["posts"].append(
    {
        "id":num,
        "name":name,
        "content":content,
        "datetime":str(postdt),
        "is_tripped":is_tripped,
        "replies":replies
    }
)

with open("threads/"+thread_id+".json","w") as f:
    json.dump(thread,f,indent=4,ensure_ascii=False)