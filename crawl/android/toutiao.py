from bs4 import BeautifulSoup as bs
import urllib
from urllib import request
import re

import sys
import os
curPath = os.path.abspath(os.path.dirname(__file__))
rootPath = os.path.split(curPath)[0]
sys.path.append(rootPath)

from common.common import Common as common
from config.config import Config as config


class Toutiao(object):
    def __init__(self, conn):
        self.conn = conn

    def start_basic_list(self):
        user_agent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36'
        headers = {'User-Agent': user_agent}
        req = urllib.request.Request('http://toutiao.io/', headers=headers)
        resp = urllib.request.urlopen(req)
        soup = bs(resp, "html.parser")
        search_user_items = soup.find_all("div", class_=re.compile("post"))

        print(len(search_user_items))

        for searchUserItem in search_user_items:

            link = searchUserItem.h3.a["href"]
            title = searchUserItem.h3.a.contents[0]

            common.insertInfoToDb(self.conn, title, '', link, '', '', '开发者头条',  config.priority_mid)
