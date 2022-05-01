import socket
with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:

    s.connect(("blogtest.vnprogramming.com",80)) 
    header=b"GET / HTTP/1.1\r\nHost: blogtest.vnprogramming.com\r\nAccept: text/html\r\nConnection: close\r\n"

    s.sendall(header)
    while 1:
        data = s.recv(1000)
        if not data:
            break
        print(data.decode())
