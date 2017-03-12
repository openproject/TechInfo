from urllib.request import urlopen
from bs4 import BeautifulSoup as bs
import re
import pymysql.cursors
from common.common import Common as common
from config.config import Config as config


class Gank(object):
    def __init__(self, conn):
        self.conn = conn

    def start_basic_list(self):
        resp = urlopen("http://gank.io/")
        soup = bs(resp, "html.parser")
        search_user_items = soup.find_all("div", class_=re.compile("outlink"))
        for searchUserItem in search_user_items:
            print(searchUserItem)
            print("=========ios:")
            print(searchUserItem.find_all("ul", recursive=False))
            ios = searchUserItem.find_all("ul", recursive=False)[0]
            for li in ios.find_all("li", recursive=False):
                title = li.a.contents[0]
                link =  li.a["href"]
                common.insertInfoToDb(self.conn, title, '', link, 'iOS', 'iOS', '干货集中营', config.priority_high)

            print("=========android:")
            android = searchUserItem.find_all("ul", recursive=False)[1]
            for li in android.find_all("li", recursive=False):
                title = li.a.contents[0]
                link =  li.a["href"]
                common.insertInfoToDb(self.conn, title, '', link, 'Android', 'Android', '干货集中营', config.priority_high)
