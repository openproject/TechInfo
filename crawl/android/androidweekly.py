from urllib.request import urlopen
from bs4 import BeautifulSoup as bs
import urllib
from urllib import request
import re
import pymysql.cursors
from common.common import Common as common
from config.config import Config as config


class AndroidWeekly(object):
    def __init__(self, conn):
        self.conn = conn

    def start_basic_list(self):
        user_agent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36'
        headers = {'User-Agent': user_agent}
        req = urllib.request.Request('http://androidweekly.net/', headers=headers)
        resp = urllib.request.urlopen(req)
        soup = bs(resp, "html.parser")
        search_user_items = soup.find_all("table", class_=re.compile("wrapper"))

        for searchUserItem in search_user_items:
            if (searchUserItem.a == None):
                try:
                    if (searchUserItem.h2.contents[0] == "Sponsored"):
                        break
                    else:
                        continue
                except Exception as e:
                    print(str(e))
                    continue

            list = searchUserItem.find_all("a", class_=re.compile("article-headline"))

            link = list[0]["href"]
            title = list[0].contents[0].strip()
            summary = searchUserItem.p.contents[0].strip()

            common.insertInfoToDb(self.conn, title, summary, link, "Android", 'Android', 'AndroidWeekly', config.priority_high)
