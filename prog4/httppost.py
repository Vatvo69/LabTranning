import argparse
import socket

def get_args():
  parser=argparse.ArgumentParser()
  parser.add_argument('--url')
  parser.add_argument('--user')
  parser.add_argument('--password')
  return parser.parse_args()

def get_domain(url):
  return url[7:-1]

def login(domain,user,password):
  with socket.socket(socket.AF_INET,socket.SOCK_STREAM) as s:
    s.connect((domain,80))
    data=f"log={user}&pwd={password}"
    header=f"POST /wp-login.php HTTP/1.1\r\nHost: {domain}\r\nContent-Length: {str(len(data))}\r\nContent-Type: application/x-www-form-urlencoded\r\nConnection: Keep-alive\r\n\r\n"
    header+=data
    s.sendall(header.encode())
    res_text=b""
    while 1:
      data=s.recv(2048)
      if not data:
        break
      res_text+=data
    if b'login_error' not in res_text:
      print(f"User {user} dang nhap thanh cong")
    else:
      print(f"User {user} dang nhap that bai")

def main():
  args=get_args()
  url,user,password=args.url,args.user,args.password
  domain=get_domain(url)
  login(domain,user,password)


if __name__ == '__main__':
  main()