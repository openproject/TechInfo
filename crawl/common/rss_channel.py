import feedparser
from common.common import Common as common

class RssChannel(object):
    def __init__(self, conn, url, category, tag, source, priority):
        self.conn = conn
        self.url = url
        self.category = category
        self.tag = tag
        self.source = source
        self.priority = priority

    def run(self):
        feed = feedparser.parse(self.url)
        entries = feed.entries

        for entry in entries:
            # print(entry)

            title = entry.title
            summary = entry.summary
            link = entry.link

            # print("title:" + title)
            # print("summary:" + summary)
            # print("link:" + link)

            common.insertInfoToDb(self.conn, title, summary, link, self.category, self.tag, self.source, self.priority)