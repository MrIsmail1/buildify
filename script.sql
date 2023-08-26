-- Database: Challenge_Stack

-- DROP DATABASE IF EXISTS "Challenge_Stack";

CREATE DATABASE "Challenge_Stack"
    WITH
    OWNER = "ESGI"
    ENCODING = 'UTF8'
    LC_COLLATE = 'en_US.utf8'
    LC_CTYPE = 'en_US.utf8'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;

-- SCHEMA: challenge_stack

-- DROP SCHEMA IF EXISTS challenge_stack ;

CREATE SCHEMA IF NOT EXISTS challenge_stack
    AUTHORIZATION "ESGI";

-- Table: challenge_stack.user

-- DROP TABLE IF EXISTS challenge_stack.user;

CREATE TABLE IF NOT EXISTS challenge_stack.user
(
    id serial PRIMARY KEY,
    firstname character varying(45) COLLATE pg_catalog."default",
    lastname character varying(45) COLLATE pg_catalog."default",
    email character varying(45) COLLATE pg_catalog."default",
    password character varying COLLATE pg_catalog."default",
    token character varying COLLATE pg_catalog."default",
    confirmation boolean DEFAULT false,
    role character varying COLLATE pg_catalog."default"
);

-- Table: challenge_stack.page

-- DROP TABLE IF EXISTS challenge_stack.page;

CREATE TABLE IF NOT EXISTS challenge_stack.page
(
    id serial PRIMARY KEY,
    pagetitle character varying(255) COLLATE pg_catalog."default",
    pageauthor character varying(255) COLLATE pg_catalog."default",
    last_modified timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    last_published timestamp without time zone,
    content text COLLATE pg_catalog."default",
    slug character varying(255) COLLATE pg_catalog."default",
    user_id integer,
    meta_description text COLLATE pg_catalog."default",
    seo_title character varying(255) COLLATE pg_catalog."default",
    CONSTRAINT user_fk FOREIGN KEY (user_id)
        REFERENCES challenge_stack.user (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

-- Table: challenge_stack.template

-- DROP TABLE IF EXISTS challenge_stack.template;

CREATE TABLE IF NOT EXISTS challenge_stack.template
(
    id serial PRIMARY KEY,
    color character varying(7) COLLATE pg_catalog."default",
    font_family character varying(50) COLLATE pg_catalog."default",
    font_size integer,
    page_id integer,
    CONSTRAINT fk_page_id FOREIGN KEY (page_id)
        REFERENCES challenge_stack.page (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

-- Table: challenge_stack.pagememento

-- DROP TABLE IF EXISTS challenge_stack.pagememento;

CREATE TABLE IF NOT EXISTS challenge_stack.pagememento
(
    id serial PRIMARY KEY,
    pagetitle character varying COLLATE pg_catalog."default",
    content text COLLATE pg_catalog."default",
    slug character varying COLLATE pg_catalog."default",
    page_id integer,
    save_date character varying(30) COLLATE pg_catalog."default",
    CONSTRAINT page_idFK FOREIGN KEY (page_id)
        REFERENCES challenge_stack.page (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
);

-- Table: challenge_stack.menu

-- DROP TABLE IF EXISTS challenge_stack.menu;

CREATE TABLE IF NOT EXISTS challenge_stack.menu
(
    id serial PRIMARY KEY,
    name character varying(25) COLLATE pg_catalog."default",
    items text[] COLLATE pg_catalog."default",
    active boolean
);

-- Table: challenge_stack.categorie

-- DROP TABLE IF EXISTS challenge_stack.categorie;

CREATE TABLE IF NOT EXISTS challenge_stack.categorie
(
    id serial PRIMARY KEY,
    title VARCHAR(255) NOT NULL
);



-- Table: challenge_stack.article

-- DROP TABLE IF EXISTS challenge_stack.article;

CREATE TABLE IF NOT EXISTS challenge_stack.article
(
    id serial PRIMARY KEY,
    articletitle VARCHAR(255),
    content TEXT,
    user_id INTEGER,
    articleauthor VARCHAR(255),
    slug VARCHAR,
    last_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_published TIMESTAMP,
    categorie_id INTEGER,
    CONSTRAINT fk_categorie_id FOREIGN KEY (categorie_id)
        REFERENCES challenge_stack.categorie (id)
        ON UPDATE CASCADE
        ON DELETE SET NULL,
    CONSTRAINT fk_user_id FOREIGN KEY (user_id)
        REFERENCES challenge_stack."user" (id)
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

-- Table: challenge_stack.articlecategorie

-- DROP TABLE IF EXISTS challenge_stack.articlecategorie;

CREATE TABLE IF NOT EXISTS challenge_stack.articlecategorie
(
    article_id INTEGER NOT NULL,
    categorie_id INTEGER NOT NULL,
    PRIMARY KEY (article_id, categorie_id),
    CONSTRAINT fk_article_id FOREIGN KEY (article_id)
        REFERENCES challenge_stack.article (id)
        ON UPDATE NO ACTION
        ON DELETE CASCADE,
    CONSTRAINT fk_categorie_id FOREIGN KEY (categorie_id)
        REFERENCES challenge_stack.categorie (id)
        ON UPDATE NO ACTION
        ON DELETE CASCADE
);




-- Table: challenge_stack.comments

-- DROP TABLE IF EXISTS challenge_stack.comments;

CREATE TABLE IF NOT EXISTS challenge_stack.comments
(
    id serial PRIMARY KEY,
    content character varying(255) COLLATE pg_catalog."default",
    date timestamp without time zone DEFAULT now(),
    idpage integer,
    comment_author character varying(255) COLLATE pg_catalog."default" DEFAULT 'default_value'::character varying,
    reported boolean,
    article_id integer,
    CONSTRAINT fk_article_id FOREIGN KEY (article_id)
        REFERENCES challenge_stack.article (id)
        ON UPDATE NO ACTION
        ON DELETE CASCADE
);

