from urllib.request import urlopen
from bs4 import BeautifulSoup as bs
import re
import pymysql.cursors
from it.common import Common as common


class Uicn(object):
    def __init__(self, conn):
        self.conn = conn

    def start_basic_list(self):
        resp = urlopen("http://www.ui.cn/?art=article#article")
        soup = bs(resp, "html.parser")
        search_user_items = soup.find_all("div", class_=re.compile("h-article-info"))
        for searchUserItem in search_user_items:
            tag = searchUserItem.find_all("span", class_=re.compile("tag"))[0].get_text()
            title = "【"+ tag +"】" + searchUserItem.find_all("span", class_=re.compile("ellipsis"))[0].get_text()
            link = "http://www.ui.cn" + searchUserItem.find_all("span", class_=re.compile("ellipsis"))[0]["href"]
            summary = searchUserItem.p.contents[0]
            common.insertInfoToDb(self.conn, title, summary, link, '设计', 'UI中国')
