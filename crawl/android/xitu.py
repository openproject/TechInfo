from bs4 import BeautifulSoup as bs
import urllib
from urllib import request
import re

import sys
import os
curPath = os.path.abspath(os.path.dirname(__file__))
rootPath = os.path.split(curPath)[0]
sys.path.append(rootPath)

from it.common import Common as common


class Xitu(object):
    def __init__(self, conn):
        self.conn = conn

    def start_basic_list(self, key, category):
        user_agent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36'
        headers = {'User-Agent': user_agent}
        req = urllib.request.Request('http://gold.xitu.io/welcome/' + key, headers=headers)
        resp = urllib.request.urlopen(req)
        soup = bs(resp, "html5lib")
        search_user_items = soup.find_all("div", class_=re.compile("entries"))[0]

        for searchUserItem in search_user_items:

            link = searchUserItem.find_all("a", class_=re.compile("entry-meta-more"))
            title = searchUserItem.find_all("div", class_=re.compile("entry-title"))[0].contents[0]


            print(searchUserItem)
            print(link)
            print(title)

            # common.insertInfoToDb(self.conn, title, '', link, category, '稀土掘金')
