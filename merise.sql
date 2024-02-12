#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------
CREATE DATABASE francesurvival CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE francesurvival;
#------------------------------------------------------------
# Table: gt3f5b_roles
#------------------------------------------------------------

CREATE TABLE gt3f5b_roles(
                             id   Int  Auto_increment  NOT NULL ,
                             name Varchar (20) NOT NULL
    ,CONSTRAINT roles_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_users
#------------------------------------------------------------

CREATE TABLE gt3f5b_users(
                             id              Int  Auto_increment  NOT NULL ,
                             username        Varchar (30) NOT NULL ,
                             birthdate       Date ,
                             email           Varchar (100) NOT NULL ,
                             password        Varchar (255) NOT NULL ,
                             phone           Varchar (15) NOT NULL ,
                             registerDate    Datetime NOT NULL ,
                             signature       Varchar (150) ,
                             avatar          Varchar (255) ,
                             description     Varchar (150) ,
                             tribe           Varchar (24)  ,
                             id_roles Int NOT NULL
    ,CONSTRAINT users_PK PRIMARY KEY (id)

    ,CONSTRAINT users_roles_FK FOREIGN KEY (id_roles) REFERENCES gt3f5b_roles(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_platforms
#------------------------------------------------------------

CREATE TABLE gt3f5b_platforms(
                                 id   Int  Auto_increment  NOT NULL ,
                                 name Varchar (20) NOT NULL
    ,CONSTRAINT platforms_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_history
#------------------------------------------------------------

CREATE TABLE gt3f5b_history(
                               id              Int  Auto_increment  NOT NULL ,
                               date            Datetime NOT NULL ,
                               ip              Varchar (20) NOT NULL ,
                               id_users Int NOT NULL
    ,CONSTRAINT history_PK PRIMARY KEY (id)

    ,CONSTRAINT history_users_FK FOREIGN KEY (id_users) REFERENCES gt3f5b_users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_articles_categories
#------------------------------------------------------------

CREATE TABLE gt3f5b_articles_categories(
                                           id   Int  Auto_increment  NOT NULL ,
                                           name Varchar (50) NOT NULL
    ,CONSTRAINT articles_categories_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_articles
#------------------------------------------------------------

CREATE TABLE gt3f5b_articles(
                                id                        Int  Auto_increment  NOT NULL ,
                                title                     Varchar (100) NOT NULL ,
                                content                   Text NOT NULL ,
                                views                     Int NOT NULL ,
                                cover                     Varchar (255) ,
                                date                      Datetime NOT NULL ,
                                id_users           Int NOT NULL ,
                                id_articles_categories Int NOT NULL
    ,CONSTRAINT articles_PK PRIMARY KEY (id)

    ,CONSTRAINT articles_users_FK FOREIGN KEY (id_users) REFERENCES gt3f5b_users(id)
    ,CONSTRAINT articles_articles_categories_FK FOREIGN KEY (id_articles_categories) REFERENCES gt3f5b_articles_categories(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_comments
#------------------------------------------------------------

CREATE TABLE gt3f5b_comments(
                                id              Int  Auto_increment  NOT NULL ,
                                content         Text NOT NULL ,
                                date            Datetime NOT NULL ,
                                id_articles Int NOT NULL ,
                                id_users Int NOT NULL
    ,CONSTRAINT comments_PK PRIMARY KEY (id)

    ,CONSTRAINT comments_articles_FK FOREIGN KEY (id_articles) REFERENCES gt3f5b_articles(id)
    ,CONSTRAINT comments_users_FK FOREIGN KEY (id_users) REFERENCES gt3f5b_users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_orders_status
#------------------------------------------------------------

CREATE TABLE gt3f5b_orders_status(
                                     id   Int  Auto_increment  NOT NULL ,
                                     name Varchar (255) NOT NULL
    ,CONSTRAINT orders_status_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_orders
#------------------------------------------------------------

CREATE TABLE gt3f5b_orders(
                              id                     Int  Auto_increment  NOT NULL ,
                              date                   Datetime NOT NULL ,
                              id_users        Int NOT NULL ,
                              id_orders_status Int NOT NULL
    ,CONSTRAINT orders_PK PRIMARY KEY (id)

    ,CONSTRAINT orders_users_FK FOREIGN KEY (id_users) REFERENCES gt3f5b_users(id)
    ,CONSTRAINT orders_orders_status_FK FOREIGN KEY (id_orders_status) REFERENCES gt3f5b_orders_status(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_events_categories
#-----------------events_categories-------------------------------------------

CREATE TABLE gt3f5b_events_categories(
                                         id   Int  Auto_increment  NOT NULL ,
                                         name Varchar (50) NOT NULL
    ,CONSTRAINT events_categories_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_events
#------------------------------------------------------------

CREATE TABLE gt3f5b_events(
                              id                        Int  Auto_increment  NOT NULL ,
                              name                      Varchar (50) NOT NULL ,
                              content                   Text NOT NULL ,
                              image                     Varchar (255) NOT NULL ,
                              creationDate              Datetime NOT NULL ,
                              startDate                 Datetime NOT NULL ,
                              endDate                   Datetime NOT NULL ,
                              id_events_categories Int NOT NULL
    ,CONSTRAINT events_PK PRIMARY KEY (id)

    ,CONSTRAINT events_events_categories_FK FOREIGN KEY (id_events_categories) REFERENCES gt3f5b_events_categories(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_products_categories
#------------------------------------------------------------

CREATE TABLE gt3f5b_products_categories(
                                           id   Int  Auto_increment  NOT NULL ,
                                           name Varchar (50) NOT NULL
    ,CONSTRAINT products_categories_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_products
#------------------------------------------------------------

CREATE TABLE gt3f5b_products(
                                id                           Int  Auto_increment  NOT NULL ,
                                name                         Varchar (50) NOT NULL ,
                                image                        Varchar (255) NOT NULL ,
                                price                        Int NOT NULL ,
                                count                        Int NOT NULL ,
                                id_products_categories Int NOT NULL
    ,CONSTRAINT products_PK PRIMARY KEY (id)
    ,CONSTRAINT products_products_categories_FK FOREIGN KEY (id_products_categories) REFERENCES gt3f5b_products_categories(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_users_platforms
#------------------------------------------------------------

CREATE TABLE gt3f5b_users_platforms(
                                       id_platforms              Int NOT NULL ,
                                       id_users Int NOT NULL
    ,CONSTRAINT users_platforms_PK PRIMARY KEY (id_platforms,id_users)
    ,CONSTRAINT users_platforms_platforms_FK FOREIGN KEY (id_platforms) REFERENCES gt3f5b_platforms(id)
    ,CONSTRAINT users_platforms_users_FK FOREIGN KEY (id_users) REFERENCES gt3f5b_users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_events_participations
#------------------------------------------------------------

CREATE TABLE gt3f5b_events_participations(
                                             id_users               Int NOT NULL ,
                                             id_events Int NOT NULL
    ,CONSTRAINT events_participations_PK PRIMARY KEY (id_users,id_events)
    ,CONSTRAINT events_participations_users_FK FOREIGN KEY (id_users) REFERENCES gt3f5b_users(id)
    ,CONSTRAINT events_participations_events_FK FOREIGN KEY (id_events) REFERENCES gt3f5b_events(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_orders_contents
#------------------------------------------------------------

CREATE TABLE gt3f5b_orders_contents(
                                       id_products               Int NOT NULL ,
                                       id_orders Int NOT NULL ,
                                       quantity         Int NOT NULL
    ,CONSTRAINT orders_contents_PK PRIMARY KEY (id_products,id_orders)
    ,CONSTRAINT orders_contents_products_FK FOREIGN KEY (id_products) REFERENCES gt3f5b_products(id)
    ,CONSTRAINT orders_contents_orders_FK FOREIGN KEY (id_orders) REFERENCES gt3f5b_orders(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gt3f5b_comments_likes
#------------------------------------------------------------

CREATE TABLE gt3f5b_comments_likes(
                                      id_comments             Int NOT NULL ,
                                      id_users Int NOT NULL
    ,CONSTRAINT comments_likes_PK PRIMARY KEY (id_comments,id_users)
    ,CONSTRAINT comments_likes_comments_FK FOREIGN KEY (id_comments) REFERENCES gt3f5b_comments(id)
    ,CONSTRAINT comments_likes_users_FK FOREIGN KEY (id_users) REFERENCES gt3f5b_users(id)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: gt3f5b_articles_likes
#------------------------------------------------------------

CREATE TABLE gt3f5b_articles_likes(
                                      id_articles             Int NOT NULL ,
                                      id_users Int NOT NULL
    ,CONSTRAINT articles_likes_PK PRIMARY KEY (id_articles,id_users)
    ,CONSTRAINT articles_likes_articles_FK FOREIGN KEY (id_articles) REFERENCES gt3f5b_articles(id)
    ,CONSTRAINT articles_likes_users_FK FOREIGN KEY (id_users) REFERENCES gt3f5b_users(id)
)ENGINE=InnoDB;

INSERT INTO `gt3f5b_roles` (`id`, `name`)
VALUES (430, 'administrateur');

INSERT INTO `gt3f5b_roles` (`id`, `name`)
VALUES (543, 'moderateur');

INSERT INTO `gt3f5b_roles` (`id`, `name`)
VALUES (1, 'membre');