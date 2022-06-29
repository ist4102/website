#python3

import urllib.request
import json

#url = "http://at.alicdn.com/t/font_579509_p2ufy3zvap4iy66r.css"
css_filename = "caomei.css"
json_filename = "caomei.json"

#urllib.request.urlretrieve(ul, css_filename)


icon_array = []
for line in open(css_filename):
    if line.startswith(".czs-"):
        icon_array.append(line[1:line.find(":")])

icon_json = {"name": "iconfont", "icons": icon_array}

with open(json_filename, 'w') as f:
    json.dump(icon_json, f)

