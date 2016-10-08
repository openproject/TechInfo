from urllib.request import urlopen
from bs4 import BeautifulSoup as bs
import re
import pymysql.cursors
from common.common import Common as common
from config.config import Config as config


class GithubTrending(object):
    def __init__(self, conn):
        self.conn = conn

    def start_basic_list(self, key, category):
        resp = urlopen("https://github.com/trending/" + key)
        soup = bs(resp, "html.parser")
        search_user_items = soup.find_all("li", class_=re.compile("repo-list-item"))

        for searchUserItem in search_user_items:
            link = "https://github.com" + searchUserItem.h3.a["href"]
            title = searchUserItem.h3.a["href"]
            try:
                summary = searchUserItem.find_all("p", class_=re.compile("repo-list-description"))[0].get_text().strip()
            except Exception as e:
                summary = ""

            common.insertInfoToDb(self.conn, title, summary, link, category, key, 'Github', config.priority_high)
