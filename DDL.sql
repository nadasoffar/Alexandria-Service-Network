CREATE DATABASE ASN;
use ASN;
CREATE TABLE user_data(
    ID INT AUTO_INCREMENT,
    fname VARCHAR(250) NOT null,
    lname VARCHAR(250) NOT null,
    pw VARCHAR(100) NOT null,
    email VARCHAR(250) UNIQUE NOT null,
    pno VARCHAR(100) NOT null,
    gender INT(10),
    date_of_birth DATE,
    profile_p VARCHAR(250)NOT null,
    city VARCHAR(250)NOT null,
    status VARCHAR(250)NOT null,
    about_me VARCHAR(250)NOT null,
    PRIMARY KEY(ID)
    );

CREATE TABLE friend_system(
   user_id int,
   friend_id int,
   status int,
   FOREIGN KEY (user_id) REFERENCES user_data(ID),
   FOREIGN KEY (friend_id) REFERENCES user_data(ID)
);

CREATE TABLE post(
   pid int AUTO_INCREMENT PRIMARY KEY,
   id int,
   txt VARCHAR(255),
   img blob,
   post_time timestamp,
   prvt int,
   FOREIGN KEY (id) REFERENCES user_data(ID)
);

CREATE TABLE likes(
   liker_id int,
   pid int,
   FOREIGN KEY (liker_id) REFERENCES user_data(ID),
   FOREIGN KEY (pid) REFERENCES post(pid)
);
