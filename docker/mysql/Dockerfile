ARG VERSION
FROM mysql:${VERSION}

ENV TZ=Europe/Madrid

ARG UID=1000
ARG GID=1000
RUN groupadd -g $GID devuser && useradd -m -u $UID  -g $GID devuser
USER devuser
