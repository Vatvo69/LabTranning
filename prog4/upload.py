import re
import socket
import argparse

def revcall(s):
  res_text=b""
  while 1:
    d=s.recv(4096)
    if not d:
      break
    res_text+=d
  return res_text

def get_args():
  parser=argparse.ArgumentParser()
  parser.add_argument('--url')
  parser.add_argument('--user')
  parser.add_argument('--password')
  parser.add_argument('--local-file')
  return parser.parse_args()

def get_domain(url):
  return url[7:-1]

def get_wpnonce(domain,cookie):
  header=f"""GET /wp-admin/media-new.php HTTP/1.1
Host: {domain}
Cookie: {cookie.decode()}
Connection: close

"""
  with socket.socket(socket.AF_INET,socket.SOCK_STREAM) as s:
    s.connect((domain,80))
    header=header.replace("\n","\r\n")
    s.sendall(header.encode())
    res_text=revcall(s)
    return re.findall(b'"post_id":0,"_wpnonce":"(.*)","type":"","tab":"","short":"1"',res_text)
    

def upload_img(cookie,local_file,domain,data_image,wpnonce):
  file_name=local_file.split("/")
  data=f"""------WebKitFormBoundarykgikusdvkfs4g55y
Content-Disposition: form-data; name="name"

{file_name[-1]}
------WebKitFormBoundarykgikusdvkfs4g55y
Content-Disposition: form-data; name="post_id"

0
------WebKitFormBoundarykgikusdvkfs4g55y
Content-Disposition: form-data; name="_wpnonce"

{wpnonce.decode()}
------WebKitFormBoundarykgikusdvkfs4g55y
Content-Disposition: form-data; name="type"


------WebKitFormBoundarykgikusdvkfs4g55y
Content-Disposition: form-data; name="tab"


------WebKitFormBoundarykgikusdvkfs4g55y
Content-Disposition: form-data; name="short"

1
------WebKitFormBoundarykgikusdvkfs4g55y
Content-Disposition: form-data; name="async-upload"; filename="{file_name[-1]}"
Content-Type: image/jpeg

{data_image}
------WebKitFormBoundarykgikusdvkfs4g55y--

"""
  new=data.replace("\n","\r\n")
  new=new.encode()
  header=f"""POST /wp-admin/async-upload.php HTTP/1.1
Content-Length: {str(len(new))}
Host: {domain}
Cookie: {cookie.decode()}
Content-Type: multipart/form-data; boundary=----WebKitFormBoundarykgikusdvkfs4g55y
Connection: close

"""
  header+=data
  header=header.replace("\n","\r\n")
  with socket.socket(socket.AF_INET,socket.SOCK_STREAM) as s:
    s.connect((domain,80))
    s.sendall(header.encode())
    res_text=revcall(s)
    id=re.findall(b'Content-Type: text/plain; charset=UTF-8\r\n\r\n(.*)',res_text)
    if 'Dismiss' in id[0].decode():
      print("Upload Failed!")
      exit(0)
    get_path(domain,cookie,id)

def get_path(domain,cookie,id):
  data=f'attachment_id={id[0].decode()}&fetch=3'
  header=f"""POST /wp-admin/async-upload.php HTTP/1.1
Host: {domain}
Content-Length: {str(len(data))}
Cookie: {cookie.decode()}
Content-Type: application/x-www-form-urlencoded; charset=UTF-8
Connection: close

"""
  header+=data
  header=header.replace("\n","\r\n")
  with socket.socket(socket.AF_INET,socket.SOCK_STREAM) as s:
    s.connect((domain,80))
    s.sendall(header.encode())
    res_text=revcall(s)
    path=re.findall(b'<button type="button" class="button button-small copy-attachment-url" data-clipboard-text="(.*)">Copy URL to clipboard</button>',res_text)
    print(f"File Upload URL: {path[0].decode()}")

def login(domain,user,password,local_file,data_image):
  with socket.socket(socket.AF_INET,socket.SOCK_STREAM) as s:
    s.connect((domain,80))
    data=f"log={user}&pwd={password}"
    header=f"""POST /wp-login.php HTTP/1.1
Host: {domain}
Content-Length: {str(len(data))}
Content-Type: application/x-www-form-urlencoded
Connection: Keep-alive

"""
    header+=data
    header=header.replace("\n","\r\n")
    s.sendall(header.encode())
    res_text=revcall(s)
    arr=res_text.split(b"\r\n")

    cookies=[]
    for i in arr:
      if b"Set-Cookie" in i:
        cookies.append(i.split()[1])
    cookie=b""
    for i in cookies:
      cookie+=i+b" "
    wpnonce=get_wpnonce(domain,cookie)
    upload_img(cookie,local_file,domain,data_image,wpnonce[0])




def main():
  args=get_args()
  url,user,password,local_file=args.url,args.user,args.password,args.local_file
  domain=get_domain(url)
  f=open(local_file,"r") 
  data=f.read()
  login(domain,user,password,local_file,data)


if __name__ == '__main__':
  main()