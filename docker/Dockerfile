FROM debian:jessie

RUN apt-get -y update

RUN echo 'deb http://packages.dotdeb.org jessie all' >> /etc/apt/sources.list
RUN echo 'deb-src http://packages.dotdeb.org jessie all' >> /etc/apt/sources.list
RUN apt-get install -y wget
RUN wget https://www.dotdeb.org/dotdeb.gpg
RUN apt-key add dotdeb.gpg

RUN apt-get -y update

RUN apt-get -y install \
    curl \
    nginx \
    php5-fpm \
    php5-common \
    php5-gd \
    php5-odbc \
    php5-intl \
    php5-mcrypt \
    php5-mysqlnd \
    telnet

ENV TZ=America/Lima
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/bin/ && composer self-update

ADD container-config /tmp
COPY container-config/backend.conf /etc/nginx/vhosts.d/

RUN /tmp/configservices.sh

EXPOSE 80 443
WORKDIR /app/
ENTRYPOINT /tmp/runservices.sh