import argparse
import socket
def get_args():
  parser=argparse.ArgumentParser(description="Download")
  parser.add_argument('--url')
  parser.add_argument('--remote-file')
  return parser.parse_args()
def get_domain(url):
  return url[7:-1]
def get_image(domain,remotefile):
  with socket.socket(socket.AF_INET,socket.SOCK_STREAM) as s:
    s.connect((domain,80))
    # header=f"GET /{remotefile} HTTP/1.1\r\nHost: {domain}\r\nConnection: close\r\n\r\n"
    header=f"""GET /{remotefile} HTTP/1.1
Host: {domain}
Connection: close

"""
    header=header.replace("\n","\r\n")
    s.sendall(header.encode())
    res_text=b''
    while 1:
      data=s.recv(2048)
      if not data:
        break
      res_text+=data
    return res_text
def main():
  args=get_args()
  url,remotefile=args.url,args.remote_file
  domain=get_domain(url)
  res_text=get_image(domain,remotefile)
  if b"Content-Type: image/" not in res_text:
    print("Khong ton tai file anh")
    exit(0)
  else:
    data=res_text.split(b"\r\n\r\n")[1]
    print("Kich Thuoc File Anh: "+str(len(data.decode('iso-8859-1')))+" bytes")
    name_image=remotefile.split("/")[-1]
    f=open(name_image,"wb")
    f.write(data)

if __name__ == '__main__':
  main()
