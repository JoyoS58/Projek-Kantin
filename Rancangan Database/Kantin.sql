/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     28/11/2023 08:58:55                          */
/*==============================================================*/
DROP DATABASE if EXISTS Kantin;
CREATE DATABASE Kantin;
use Kantin;
drop table if exists DETAILTRANSAKSISUPPLIER;

drop table if exists DETAIL_TRANSAKSI;

drop table if exists PRODUK;

drop table if exists SUPPLIER;

drop table if exists TRANSAKSI;

drop table if exists USERS;

/*==============================================================*/
/* Table: DETAILTRANSAKSISUPPLIER                               */
/*==============================================================*/
create table DETAILTRANSAKSISUPPLIER
(
   ID_PRODUK            int not null,
   SUPPLIER_ID          int not null,
   ID_DETAILTRANSAKSI   int not null,
   JUMLAH               int,
   TANGGALSUPPLY        date,
   HARGASUPPLIER        decimal(10,3),
   RETUR               decimal(10,3),
   primary key (ID_DETAILTRANSAKSI)
);

/*==============================================================*/
/* Table: DETAI_TRANSAKSI                                       */
/*==============================================================*/
create table DETAIL_TRANSAKSI
(
   ID_DETAIL_TRANSAKSI   int not null,
   ID_PRODUK            int,
   ID_TRANSAKSI         int,
   QTY                  int,
   HARGA                decimal(10,3),
   SUB_TOTAL            decimal(10,3),
   JUMLAH_BAYAR         decimal(10,3),
   SISA_BAYAR           decimal(10,3),
   primary key (ID_DETAIL_TRANSAKSI)
);

/*==============================================================*/
/* Table: PRODUK                                                */
/*==============================================================*/
create table PRODUK
(
   ID_PRODUK            int not null,
   NAMA_PRODUK          varchar(100),
   KATEGORI             varchar(100),
   STOK                 int,
   HARGA                decimal(10,3),
   primary key (ID_PRODUK)
);

/*==============================================================*/
/* Table: SUPPLIER                                              */
/*==============================================================*/
create table SUPPLIER
(
   SUPPLIER_ID          int not null,
   NAMA_SUPPLIER        varchar(100) not null,
   NO_TELP              varchar(15),
   primary key (SUPPLIER_ID)
);

/*==============================================================*/
/* Table: TRANSAKSI                                             */
/*==============================================================*/
create table TRANSAKSI
(
   ID_TRANSAKSI         int not null,
   ID_USER              int not null,
   JENIS_PEMBAYARAN     varchar(50),
   TGL_TRANSAKSI        datetime,
   TOTAL_HARGA          decimal(10,3),
   primary key (ID_TRANSAKSI)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USERS
(
   ID_USER              int not null,
   NAMA                 varchar(100),
   USER_NAME            varchar(100),
   PASSWORD             varchar(100),
   LEVEL                enum("Pemilik","Kasir"), 
   primary key (ID_USER)
);

alter table DETAILTRANSAKSISUPPLIER add constraint FK_MENSUPLY foreign key (ID_PRODUK)
      references PRODUK (ID_PRODUK);

alter table DETAILTRANSAKSISUPPLIER add constraint FK_MENSUPLY2 foreign key (SUPPLIER_ID)
      references SUPPLIER (SUPPLIER_ID);

alter table DETAIL_TRANSAKSI add constraint FK_MELIBATKAN foreign key (ID_PRODUK)
      references PRODUK (ID_PRODUK);

alter table DETAIL_TRANSAKSI add constraint FK_MELIBATKAN2 foreign key (ID_TRANSAKSI)
      references TRANSAKSI (ID_TRANSAKSI);

alter table TRANSAKSI add constraint FK_MELAYANI foreign key (ID_USER)
      references USERS (ID_USER);

