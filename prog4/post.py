import socket
URL="blogtest.vnprogramming.com"

with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
  s.connect((URL,80))
  username=input("Nhap username: ")
  password=input("Nhap password: ")
  data="log="+username+"&pwd="+password
  header="POST /wp-login.php HTTP/1.1\r\nHost: blogtest.vnprogramming.com\r\nContent-Type: application/x-www-form-urlencoded\r\nContent-Length: "+str(len(data))+"\r\nConnection: keep-alive\r\n\r\n"
  header+=data
  s.sendall(header.encode())
  response_text=b""
  while 1:
    data=s.recv(1024)
    if not data:
      break
    response_text+=data
  if b"login_error" in response_text:
    print("User "+username+" dang nhap that bai")
  else:
    print("User "+username+" dang nhap thanh cong")
