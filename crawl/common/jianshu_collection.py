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
        article_list_ul = soup.find_all("ul", class_=re.compile("article-list"))[0]
        article_list_lis = article_list_ul.find_all("li")

        for article_li in article_list_lis:

            link = "http://www.jianshu.com" + article_li.h4.a["href"]
            title = article_li.h4.a.contents[0]

            common.insertInfoToDb(self.conn, title, "", link, self.category, self.tag, self.source, self.priority)
