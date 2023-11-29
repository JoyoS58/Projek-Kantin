/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     28/11/2023 08:58:55                          */
/*==============================================================*/

CREATE DATABASE Kantin;
use Kantin;
drop table if exists DETAILTRANSAKSISUPPLIER;

drop table if exists DETAI_TRANSAKSI;

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
   "RETURN"             decimal(10,3),
   primary key (ID_DETAILTRANSAKSI)
);

/*==============================================================*/
/* Table: DETAI_TRANSAKSI                                       */
/*==============================================================*/
create table DETAI_TRANSAKSI
(
   ID_DETAI_TRANSAKSI   int not null,
   ID_PRODUK            int not null,
   ID_TRANSAKSI         int not null,
   QTY                  int not null,
   HARGA                decimal(10,3) not null,
   SUB_TOTAL            decimal(10,3) not null,
   JUMLAH_BAYAR         decimal(10,3) not null,
   SISA_BAYAR           decimal(10,3) not null,
   primary key (ID_DETAI_TRANSAKSI)
);

/*==============================================================*/
/* Table: PRODUK                                                */
/*==============================================================*/
create table PRODUK
(
   ID_PRODUK            int not null,
   NAMA_PRODUK          varchar(100) not null,
   KATEGORI             varchar(100) not null,
   STOK                 int not null,
   HARGA                decimal(10,3) not null,
   primary key (ID_PRODUK)
);

/*==============================================================*/
/* Table: SUPPLIER                                              */
/*==============================================================*/
create table SUPPLIER
(
   SUPPLIER_ID          int not null,
   NAMA_SUPPLIER        varchar(100) not null,
   NO_TELP              varchar(15) not null,
   primary key (SUPPLIER_ID)
);

/*==============================================================*/
/* Table: TRANSAKSI                                             */
/*==============================================================*/
create table TRANSAKSI
(
   ID_TRANSAKSI         int not null,
   ID_USER              int not null,
   JENIS_PEMBAYARAN     varchar(50) not null,
   TGL_TRANSAKSI        datetime not null,
   TOTAL_HARGA          decimal(10,3) not null,
   primary key (ID_TRANSAKSI)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USERS
(
   ID_USER              int not null,
   NAMA                 varchar(100) not null,
   USER_NAME            varchar(100) not null,
   PASSWORD             varchar(100) not null,
   LEVEL                varchar(50) not null,
   primary key (ID_USER)
);

alter table DETAILTRANSAKSISUPPLIER add constraint FK_MENSUPLY foreign key (ID_PRODUK)
      references PRODUK (ID_PRODUK);

alter table DETAILTRANSAKSISUPPLIER add constraint FK_MENSUPLY2 foreign key (SUPPLIER_ID)
      references SUPPLIER (SUPPLIER_ID);

alter table DETAI_TRANSAKSI add constraint FK_MELIBATKAN foreign key (ID_PRODUK)
      references PRODUK (ID_PRODUK);

alter table DETAI_TRANSAKSI add constraint FK_MELIBATKAN2 foreign key (ID_TRANSAKSI)
      references TRANSAKSI (ID_TRANSAKSI);

alter table TRANSAKSI add constraint FK_MELAYANI foreign key (ID_USER)
      references USERS (ID_USER);

