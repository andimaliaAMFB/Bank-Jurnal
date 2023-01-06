/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     06/01/2023 20:41:26                          */
/*==============================================================*/


alter table AKUN 
   drop foreign key FK_AKUN_AKUN_PENU_PENULIS;

alter table AKUN 
   drop foreign key FK_AKUN_PROFIL_AK_KOTA;

alter table AKUN 
   drop foreign key FK_AKUN_PROFIL_AK_PROVINSI;

alter table ARTIKEL_DETAIL 
   drop foreign key FK_ARTIKEL__ARTIKEL_A_AKUN;

alter table ARTIKEL_DETAIL 
   drop foreign key FK_ARTIKEL__DETAIL_AR_ARTIKEL;

alter table ARTIKEL_DETAIL 
   drop foreign key FK_ARTIKEL__PENULIS_A_PENULIS;

alter table ARTIKEL_DETAIL 
   drop foreign key FK_ARTIKEL__REVISI_AR_REVISI;

alter table PENULIS 
   drop foreign key FK_PENULIS_AKUN_PENU_AKUN;

alter table PENULIS 
   drop foreign key FK_PENULIS_JURUSAN_P_JURUSAN;

alter table REVISI 
   drop foreign key FK_REVISI_ADMIN_PE__AKUN;

alter table REVISI 
   drop foreign key FK_REVISI_REVISI_AR_ARTIKEL_;

alter table REVISI_DETAIL 
   drop foreign key FK_REVISI_D_DETAIL_RE_REVISI;


alter table AKUN 
   drop foreign key FK_AKUN_AKUN_PENU_PENULIS;

alter table AKUN 
   drop foreign key FK_AKUN_PROFIL_AK_KOTA;

alter table AKUN 
   drop foreign key FK_AKUN_PROFIL_AK_PROVINSI;

drop table if exists AKUN;

drop table if exists ARTIKEL;


alter table ARTIKEL_DETAIL 
   drop foreign key FK_ARTIKEL__ARTIKEL_A_AKUN;

alter table ARTIKEL_DETAIL 
   drop foreign key FK_ARTIKEL__DETAIL_AR_ARTIKEL;

alter table ARTIKEL_DETAIL 
   drop foreign key FK_ARTIKEL__REVISI_AR_REVISI;

alter table ARTIKEL_DETAIL 
   drop foreign key FK_ARTIKEL__PENULIS_A_PENULIS;

drop table if exists ARTIKEL_DETAIL;

drop table if exists JURUSAN;

drop table if exists KOTA;


alter table PENULIS 
   drop foreign key FK_PENULIS_AKUN_PENU_AKUN;

alter table PENULIS 
   drop foreign key FK_PENULIS_JURUSAN_P_JURUSAN;

drop table if exists PENULIS;

drop table if exists PROVINSI;


alter table REVISI 
   drop foreign key FK_REVISI_REVISI_AR_ARTIKEL_;

alter table REVISI 
   drop foreign key FK_REVISI_ADMIN_PE__AKUN;

drop table if exists REVISI;


alter table REVISI_DETAIL 
   drop foreign key FK_REVISI_D_DETAIL_RE_REVISI;

drop table if exists REVISI_DETAIL;

/*==============================================================*/
/* Table: AKUN                                                  */
/*==============================================================*/
create table AKUN
(
   ID_AKUN              varchar(12) not null  comment '',
   ID_PENULIS           varchar(12)  comment '',
   ID_KOTA              varchar(12) not null  comment '',
   ID_PROVINSI          varchar(12) not null  comment '',
   USERNAME             varchar(20) not null  comment '',
   PASSWORD             varchar(12) not null  comment '',
   NAMA                 varchar(20) not null  comment '',
   STATUS_PENGGUNAAN    varchar(12) not null  comment '',
   TANGGAL_LAHIR        date not null  comment '',
   NO_TELEPON           varchar(12) not null  comment '',
   EMAIL                varchar(20) not null  comment '',
   ALAMAT               varchar(200) not null  comment '',
   primary key (ID_AKUN)
);

/*==============================================================*/
/* Table: ARTIKEL                                               */
/*==============================================================*/
create table ARTIKEL
(
   ID_ARTIKEL           varchar(12) not null  comment '',
   primary key (ID_ARTIKEL)
);

/*==============================================================*/
/* Table: ARTIKEL_DETAIL                                        */
/*==============================================================*/
create table ARTIKEL_DETAIL
(
   ID_PENULIS           varchar(12) not null  comment '',
   ID_ARTIKEL           varchar(12) not null  comment '',
   ID_AKUN              varchar(12) not null  comment '',
   ID_DETAILARTIKEL     varchar(12) not null  comment '',
   ID_REVISI            varchar(12)  comment '',
   JUDUL_ARTIKEL        varchar(20) not null  comment '',
   TANGGAL_UPLOAD       datetime not null  comment '',
   STATUS_ARTIKEL       varchar(12) not null  comment '',
   primary key (ID_PENULIS, ID_ARTIKEL, ID_AKUN, ID_DETAILARTIKEL)
);

/*==============================================================*/
/* Table: JURUSAN                                               */
/*==============================================================*/
create table JURUSAN
(
   ID_JURUSAN           varchar(12) not null  comment '',
   NAMA_JURUSAN         varchar(20) not null  comment '',
   primary key (ID_JURUSAN)
);

/*==============================================================*/
/* Table: KOTA                                                  */
/*==============================================================*/
create table KOTA
(
   ID_KOTA              varchar(12) not null  comment '',
   NAMA_KOTA            varchar(20) not null  comment '',
   primary key (ID_KOTA)
);

/*==============================================================*/
/* Table: PENULIS                                               */
/*==============================================================*/
create table PENULIS
(
   ID_PENULIS           varchar(12) not null  comment '',
   ID_AKUN              varchar(12) not null  comment '',
   ID_JURUSAN           varchar(12) not null  comment '',
   NAMA_PENULIS         varchar(20) not null  comment '',
   primary key (ID_PENULIS)
);

/*==============================================================*/
/* Table: PROVINSI                                              */
/*==============================================================*/
create table PROVINSI
(
   ID_PROVINSI          varchar(12) not null  comment '',
   NAMA_PROVINSI        varchar(20) not null  comment '',
   primary key (ID_PROVINSI)
);

/*==============================================================*/
/* Table: REVISI                                                */
/*==============================================================*/
create table REVISI
(
   ID_REVISI            varchar(12) not null  comment '',
   ID_PENULIS           varchar(12) not null  comment '',
   ID_ARTIKEL           varchar(12) not null  comment '',
   ID_AKUN              varchar(12) not null  comment '',
   ID_DETAILARTIKEL     varchar(12) not null  comment '',
   AKU_ID_AKUN          varchar(12) not null  comment '',
   primary key (ID_REVISI)
);

/*==============================================================*/
/* Table: REVISI_DETAIL                                         */
/*==============================================================*/
create table REVISI_DETAIL
(
   ID_DETAILREVISI      varchar(12) not null  comment '',
   ID_REVISI            varchar(12) not null  comment '',
   TANGGAL_REVISI       datetime not null  comment '',
   STATUS_REVISI        varchar(12) not null  comment '',
   REVISI               text not null  comment '',
   primary key (ID_DETAILREVISI)
);

alter table AKUN add constraint FK_AKUN_AKUN_PENU_PENULIS foreign key (ID_PENULIS)
      references PENULIS (ID_PENULIS) on delete restrict on update restrict;

alter table AKUN add constraint FK_AKUN_PROFIL_AK_KOTA foreign key (ID_KOTA)
      references KOTA (ID_KOTA) on delete restrict on update restrict;

alter table AKUN add constraint FK_AKUN_PROFIL_AK_PROVINSI foreign key (ID_PROVINSI)
      references PROVINSI (ID_PROVINSI) on delete restrict on update restrict;

alter table ARTIKEL_DETAIL add constraint FK_ARTIKEL__ARTIKEL_A_AKUN foreign key (ID_AKUN)
      references AKUN (ID_AKUN) on delete restrict on update restrict;

alter table ARTIKEL_DETAIL add constraint FK_ARTIKEL__DETAIL_AR_ARTIKEL foreign key (ID_ARTIKEL)
      references ARTIKEL (ID_ARTIKEL) on delete restrict on update restrict;

alter table ARTIKEL_DETAIL add constraint FK_ARTIKEL__PENULIS_A_PENULIS foreign key (ID_PENULIS)
      references PENULIS (ID_PENULIS) on delete restrict on update restrict;

alter table ARTIKEL_DETAIL add constraint FK_ARTIKEL__REVISI_AR_REVISI foreign key (ID_REVISI)
      references REVISI (ID_REVISI) on delete restrict on update restrict;

alter table PENULIS add constraint FK_PENULIS_AKUN_PENU_AKUN foreign key (ID_AKUN)
      references AKUN (ID_AKUN) on delete restrict on update restrict;

alter table PENULIS add constraint FK_PENULIS_JURUSAN_P_JURUSAN foreign key (ID_JURUSAN)
      references JURUSAN (ID_JURUSAN) on delete restrict on update restrict;

alter table REVISI add constraint FK_REVISI_ADMIN_PE__AKUN foreign key (AKU_ID_AKUN)
      references AKUN (ID_AKUN) on delete restrict on update restrict;

alter table REVISI add constraint FK_REVISI_REVISI_AR_ARTIKEL_ foreign key (ID_PENULIS, ID_ARTIKEL, ID_AKUN, ID_DETAILARTIKEL)
      references ARTIKEL_DETAIL (ID_PENULIS, ID_ARTIKEL, ID_AKUN, ID_DETAILARTIKEL) on delete restrict on update restrict;

alter table REVISI_DETAIL add constraint FK_REVISI_D_DETAIL_RE_REVISI foreign key (ID_REVISI)
      references REVISI (ID_REVISI) on delete restrict on update restrict;

