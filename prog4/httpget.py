import argparse
import socket
import re
import html
def get_args():
  args=argparse.ArgumentParser()
  args.add_argument('--url')
  return args.parse_args()
def get_domain(url):
  return url[7:-1]

def get(url):
  with socket.socket(socket.AF_INET,socket.SOCK_STREAM) as s:
    s.connect((url,80))
    header=f"GET / HTTP/1.1\r\nHost: {url}\r\nConnection: close\r\n\r\n"
    s.sendall(f'{header}'.encode())
    while 1:
      data=s.recv(2048)
      title=re.findall(b'<title>(.*)</title>',data)
      if len(title)!=0:
        print(f"Title: {html.unescape(title[0].decode())}")
        exit(0)
      if not data:
        break
    
    
def main():
  args=get_args()
  url=args.url
  domain=get_domain(url)
  get(domain)


if __name__ == '__main__':
  main()