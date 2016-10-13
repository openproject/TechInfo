from urllib.request import urlopen
from bs4 import BeautifulSoup as bs
import urllib
from urllib import request
import re
import pymysql.cursors
from common.common import Common as common
from config.config import Config as config


class Geek(object):
    def __init__(self, conn):
        self.conn = conn

    def start_basic_list(self):
        user_agent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36'
        headers = {'User-Agent': user_agent}
        req = urllib.request.Request('http://geek.csdn.net/new', headers=headers)
        resp = urllib.request.urlopen(req)
        soup = bs(resp, "html.parser")
        search_user_items = soup.find_all("dl", class_=re.compile("geek_list"))

        print(len(search_user_items))

        for searchUserItem in search_user_items:
            geeklist = searchUserItem.find_all("span", class_=re.compile("tracking-ad"))

            index = 2
            if (len(geeklist) < 3):
               index = 1

            link = geeklist[index].a["href"]
            title = geeklist[index].a.contents[0]
            category = searchUserItem.ul.find_all("li")[2].a.contents[0]
            tag = category

            if (category == "Java" or category == "Android开发者"):
                tag = 'Android'


            common.insertInfoToDb(self.conn, title, '', link, category, tag, '极客头条', config.priority_mid)
