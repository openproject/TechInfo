from urllib.request import urlopen
from bs4 import BeautifulSoup as bs
import re
import pymysql.cursors
from common.common import Common as common
from config.config import Config as config

from selenium import webdriver
from selenium.webdriver.common import by


class JianshuCollection(object):
    def __init__(self, conn, url, category, tag, source, priority):
        self.conn = conn
        self.url = url
        self.category = category
        self.tag = tag
        self.source = source
        self.priority = priority

    def run(self):
        resp = urlopen(self.url)
        soup = bs(resp, "html.parser")
        article_list_ul = soup.find_all("ul", class_=re.compile("note-list"))[0]
        article_list_lis = article_list_ul.find_all("li")

        for article_li in article_list_lis:

            article_li_a = article_li.div.find_all("a", class_=re.compile("title"))[0]
            print(article_li_a)
            link = "http://www.jianshu.com" + article_li.a["href"]
            title = article_li_a.contents[0]
            summary = article_li.div.p.contents[0].strip()

            # print(link)
            # print("====title:" + title)
            # print(summary)

            common.insertInfoToDb(self.conn, title, summary, link, self.category, self.tag, self.source, self.priority)
