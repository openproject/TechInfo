from urllib.request import urlopen
from bs4 import BeautifulSoup as bs
import re
import pymysql.cursors
from it.common import Common as common


class Zcool(object):
    def __init__(self, conn):
        self.conn = conn

    def start_basic_list(self):
        resp = urlopen("http://www.zcool.com.cn/articles/")
        soup = bs(resp, "html.parser")
        search_user_items = soup.find_all("div", class_=re.compile("upJyBox"))[0].ul.find_all("li")
        for searchUserItem in search_user_items:
            title = searchUserItem.a["title"].strip()
            link = searchUserItem.a["href"]
            summary = searchUserItem.find_all("p", class_=re.compile("ofHidden"))[0].contents[0].strip()

            common.insertInfoToDb(self.conn, title, summary, link, '设计', '站酷')
