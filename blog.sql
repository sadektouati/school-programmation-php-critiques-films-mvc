drop database pr_blog;
create database pr_blog;

use pr_blog;

create table if not exists usager(
    id int unsigned auto_increment primary key,
    nom_usager varchar(50) not null unique,
    mot_de_passe varchar(255) not null
);

create table article(
    id int unsigned auto_increment primary key,
    id_auteur int unsigned not null,
    titre varchar(200) not null,
    texte text not null
);

alter table article add constraint fk_article_usager foreign key (id_auteur) references usager(id);
