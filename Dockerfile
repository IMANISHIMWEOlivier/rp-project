FROM quicksetup/xampp
WORKDIR /www
COPY . /www
EXPOSE 22
EXPOSE 80