import util
import sys
import datetime
import json

args = sys.argv
tid=util.gen_rand_strs(20)
title=args[1]

pid=1
name=args[2]
content=args[3]
postdt=datetime.datetime.now()
is_tripped=False

dic_thread={
    "id":tid,
    "title":title,
    "posts":[
        {
            "id":pid,
            "name":name,
            "content":content,
            "datetime":str(postdt),
            "is_tripped":is_tripped,
            "replies":[]
        }
    ]
}

with open("threads/"+tid+".json","w") as f:
    json.dump(dic_thread,f,indent=4,ensure_ascii=False)