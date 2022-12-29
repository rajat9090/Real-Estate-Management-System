-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 29, 2022 at 05:23 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rems`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `chgpwd`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `chgpwd` (IN `ucod` INT, IN `oldpwd` VARCHAR(50), IN `newpwd` VARCHAR(50), OUT `ret` INT)  NO SQL
BEGIN
declare actpwd varchar(50);
select usrpwd from tbusr where usrcod=ucod into
@actpwd;
if oldpwd=@actpwd then
update tbusr set usrpwd=newpwd where usrcod=ucod;
 set ret=1;
else
 set ret=0;
end if;
END$$

DROP PROCEDURE IF EXISTS `delagt`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delagt` (IN `acod` INT)  NO SQL
delete from tbagt WHERE agtcod=acod$$

DROP PROCEDURE IF EXISTS `delagtrev`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delagtrev` (IN `arevcod` INT)  NO SQL
delete from tbagtrev where agtrevcod=arevcod$$

DROP PROCEDURE IF EXISTS `delapp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delapp` (IN `acod` INT)  NO SQL
DELETE FROM tbapp where appcod=acod$$

DROP PROCEDURE IF EXISTS `delcty`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delcty` (IN `ccod` INT)  NO SQL
delete from  tbcty where ctycod=ccod$$

DROP PROCEDURE IF EXISTS `delfav`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delfav` (IN `fcod` INT)  NO SQL
DELETE from  tbfav WHERE favcod=fcod$$

DROP PROCEDURE IF EXISTS `delfet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delfet` (IN `fcod` INT)  NO SQL
DELETE from  tbfet WHERE fetcod=fcod$$

DROP PROCEDURE IF EXISTS `delloc`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delloc` (IN `lcod` INT)  NO SQL
DELETE from   tbloc WHERE loccod=lcod$$

DROP PROCEDURE IF EXISTS `delprp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delprp` (IN `pcod` INT)  NO SQL
DELETE from  tbprp WHERE prpcod=pcod$$

DROP PROCEDURE IF EXISTS `delprpfet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delprpfet` (IN `pfetcod` INT)  NO SQL
delete FROM tbprpfet WHERE prpfetcod=pfetcod$$

DROP PROCEDURE IF EXISTS `delprppic`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delprppic` (IN `piccod` INT)  NO SQL
delete FROM tbprppic WHERE prppiccod=piccod$$

DROP PROCEDURE IF EXISTS `delprptyp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delprptyp` (IN `ptypcod` INT)  NO SQL
DELETE from  tbprptyp WHERE prptypcod=ptypcod$$

DROP PROCEDURE IF EXISTS `delusr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delusr` (IN `ucod` INT)  NO SQL
DELETE FROM tbusr WHERE usrcod=ucod$$

DROP PROCEDURE IF EXISTS `dispapp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dispapp` (IN `pcod` INT)  NO SQL
BEGIN
select appcod,appdat,appdsc,appphn,appsts,appname,usreml from tbapp,tbusr
where appusrcod=usrcod and appprpcod=pcod order by appdat desc;
END$$

DROP PROCEDURE IF EXISTS `dispfav`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dispfav` (IN `ucod` INT)  NO SQL
BEGIN
select prpcod,prptit,prpadd,prpcrd,prpdsc,prpprc,prplstdat, (select prppicfil from tbprppic where prppiccod=a.prpmanpiccod) pic,agtcod,agtnam,(select ifnull( avg(agtrevscr),0) from tbagtrev where agtrevagtcod=b.agtcod) rev from tbprp a,tbagt b where prpagtcod=agtcod and prpcod in(select favprpcod from tbfav where favusrcod=ucod) and prpsts='A' order by prplstdat desc;
END$$

DROP PROCEDURE IF EXISTS `dispprpfet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dispprpfet` (IN `pcod` INT)  NO SQL
BEGIN
select prpfetcod,prpfetfetcod,fetdsc,prpfetdsc
from tbprpfet,tbfet where prpfetfetcod=fetcod and
prpfetprpcod=pcod;
END$$

DROP PROCEDURE IF EXISTS `dspagt`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspagt` ()  NO SQL
select * from tbagt$$

DROP PROCEDURE IF EXISTS `dspagtbyloc`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspagtbyloc` (IN `lcod` INT)  NO SQL
BEGIN
select agtcod,agtnam,agtser,agtpic,agtprf,usrregdat, (select ifnull(avg(agtrevscr),0) from tbagtrev where agtrevagtcod=a.agtcod) revscr,(select ifnull(count(*),0) from tbagtrev where agtrevagtcod=a.agtcod) revcnt,(select ifnull(count(*),0) from tbprp where prpagtcod=a.agtcod)nop from tbagt a, tbusr where agtusrcod=usrcod and agtloccod=lcod order by revscr desc;
END$$

DROP PROCEDURE IF EXISTS `dspagtprf`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspagtprf` (IN `acod` INT)  NO SQL
BEGIN
select agtcod,agtnam,agtser,agtpic,agtprf,usrregdat, (select ifnull(avg(agtrevscr),0) from tbagtrev where agtrevagtcod=a.agtcod) revscr, (select ifnull(count(*),0) from tbagtrev where agtrevagtcod=a.agtcod) revcnt,(select ifnull(count(*),0) from tbprp where prpagtcod=a.agtcod)nop from tbagt a, tbusr where agtusrcod=usrcod and agtcod=acod;
END$$

DROP PROCEDURE IF EXISTS `dspagtprp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspagtprp` (IN `pcod` INT)  NO SQL
BEGIN
select prpcod,prptit,prpadd,prpcrd,prpdsc,prpprc,prplstdat,
(select prppicfil from tbprppic
where prppiccod=a.prpmanpiccod) pic,prpsts,prpsalsts 
from tbprp a where prpagtcod=pcod and prpsts!='C' order by
  prplstdat desc;
END$$

DROP PROCEDURE IF EXISTS `dspagtrev`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspagtrev` (IN `acod` INT)  NO SQL
BEGIN
select agtrevtit,agtrevdsc,agtrevscr,agtrevdat,prptit,usreml
from tbagtrev,tbprp,tbusr where agtrevprpcod=prpcod and agtrevusrcod=
usrcod and agtrevagtcod=acod order by agtrevdat desc;
END$$

DROP PROCEDURE IF EXISTS `dspagttit`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspagttit` (IN `ucod` INT)  NO SQL
BEGIN
select agtcod,agtnam from tbprp,tbagt,tbapp where appusrcod=6 and appprpcod=prpcod and prpagtcod=agtcod order by appdat desc;
END$$

DROP PROCEDURE IF EXISTS `dspapp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspapp` ()  NO SQL
SELECT * FROM tbapp$$

DROP PROCEDURE IF EXISTS `dspcty`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspcty` ()  NO SQL
SELECT * from  tbcty$$

DROP PROCEDURE IF EXISTS `dspfav`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspfav` ()  NO SQL
SELECT * FROM tbfav$$

DROP PROCEDURE IF EXISTS `dspfet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspfet` ()  NO SQL
SELECT * from  tbfet$$

DROP PROCEDURE IF EXISTS `dsploc`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dsploc` (IN `lcod` INT)  NO SQL
SELECT * from   tbloc where locctycod=lcod$$

DROP PROCEDURE IF EXISTS `dspprp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspprp` (IN `pcod` INT)  NO SQL
SELECT * from  tbprp$$

DROP PROCEDURE IF EXISTS `dspprpdet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspprpdet` (IN `pcod` INT)  NO SQL
BEGIN
select prpcod,prptit,prpadd,prpcrd,prpsalsts,prpdsc,prpprc,prplstdat,(select prppicfil from tbprppic where prppiccod=a.prpmanpiccod) pic from tbprp a where prpcod=pcod;
end$$

DROP PROCEDURE IF EXISTS `dspprpfet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspprpfet` ()  NO SQL
SELECT * FROM tbprpfet$$

DROP PROCEDURE IF EXISTS `dspprppic`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspprppic` ()  NO SQL
SELECT *  FROM tbprppic$$

DROP PROCEDURE IF EXISTS `dspprppict`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspprppict` (IN `pcod` INT)  NO SQL
BEGIN
SELECT * from tbprppic where prppicprpcod=pcod;
END$$

DROP PROCEDURE IF EXISTS `dspprptit`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspprptit` (IN `ucod` INT)  NO SQL
BEGIN
select prpcod,concat(CONVERT(appdat ,date),',',prptit) det from tbprp,tbagt,tbapp where appusrcod=ucod and appprpcod=prpcod and prpagtcod=agtcod order by appdat desc;
END$$

DROP PROCEDURE IF EXISTS `dspprptyp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspprptyp` ()  NO SQL
select * from  tbprptyp$$

DROP PROCEDURE IF EXISTS `dspusr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspusr` ()  NO SQL
SELECT * FROM tbusr$$

DROP PROCEDURE IF EXISTS `dspusrapp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspusrapp` (IN `ucod` INT)  NO SQL
BEGIN
select appcod,prpcod,prptit,agtcod,agtnam,concat(CONVERT(appdat ,date),',',prptit,',',agtnam) det from tbprp,tbagt,tbapp where appusrcod=ucod and appprpcod=prpcod and prpagtcod=agtcod order by appdat desc;
end$$

DROP PROCEDURE IF EXISTS `fndagt`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndagt` (IN `acod` INT)  NO SQL
SELECT * from tbagt WHERE agtcod=acod$$

DROP PROCEDURE IF EXISTS `fndagtrev`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndagtrev` (IN `arevcod` INT)  NO SQL
SELECT * from tbagtrev where agtrevcod=arevcod$$

DROP PROCEDURE IF EXISTS `fndapp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndapp` (IN `acod` INT)  NO SQL
SELECT * FROM tbapp where appcod=acod$$

DROP PROCEDURE IF EXISTS `fndcty`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndcty` (IN `ccod` INT)  NO SQL
SELECT * from  tbcty where ctycod=ccod$$

DROP PROCEDURE IF EXISTS `fndfav`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndfav` (IN `fcod` INT)  NO SQL
SELECT * from  tbfav WHERE favcod=fcod$$

DROP PROCEDURE IF EXISTS `fndfet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndfet` (IN `fcod` INT)  NO SQL
SELECT * from  tbfet WHERE fetcod=fcod$$

DROP PROCEDURE IF EXISTS `fndloc`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndloc` (IN `lcod` INT)  NO SQL
SELECT * from   tbloc WHERE loccod=lcod$$

DROP PROCEDURE IF EXISTS `fndprp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndprp` (IN `pcod` INT)  NO SQL
SELECT * from  tbprp WHERE prpcod=pcod$$

DROP PROCEDURE IF EXISTS `fndprpfet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndprpfet` (IN `pfetcod` INT)  NO SQL
SELECT * FROM tbprpfet WHERE prpfetcod=pfetcod$$

DROP PROCEDURE IF EXISTS `fndprppic`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndprppic` (IN `prppiccod` INT)  NO SQL
SELECT *  FROM tbprppic WHERE prppiccod=ppiccod$$

DROP PROCEDURE IF EXISTS `fndprptyp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndprptyp` (IN `ptypcod` INT)  NO SQL
SELECT * from  tbprptyp WHERE prptypcod=ptypcod$$

DROP PROCEDURE IF EXISTS `fndusr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndusr` (IN `ucod` INT)  NO SQL
SELECT * FROM tbusr WHERE usrcod=ucod$$

DROP PROCEDURE IF EXISTS `insagt`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insagt` (IN `anam` VARCHAR(100), IN `aloccod` INT, IN `aser` VARCHAR(100), IN `apic` VARCHAR(50), IN `aprf` VARCHAR(10000), IN `ausrcod` INT)  NO SQL
insert tbagt values (null,anam,aloccod,aser,apic,aprf,ausrcod)$$

DROP PROCEDURE IF EXISTS `insagtrev`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insagtrev` (IN `arevagtcod` INT, IN `arevusrcod` INT, IN `arevprpcod` INT, IN `arevdat` DATETIME, IN `arevtit` VARCHAR(50), IN `arevdsc` VARCHAR(2000), IN `arevscr` INT)  NO SQL
INSERT tbagtrev VALUES(null, arevagtcod,arevusrcod,arevprpcod, arevdat,arevtit,arevdsc,arevscr)$$

DROP PROCEDURE IF EXISTS `insapp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insapp` (IN `ausrcod` INT, IN `aprpcod` INT, IN `anam` VARCHAR(50), IN `adat` DATETIME, IN `adsc` VARCHAR(2000), IN `aphn` VARCHAR(100), IN `asts` CHAR(1))  NO SQL
INSERT tbapp VALUES(null,ausrcod,aprpcod,anam,adat,adsc,aphn,
asts)$$

DROP PROCEDURE IF EXISTS `inscty`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `inscty` (IN `cnam` VARCHAR(100))  NO SQL
INSERT tbcty values(null,cnam)$$

DROP PROCEDURE IF EXISTS `insfav`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insfav` (IN `fusrcod` INT, IN `fprpcod` INT, IN `fdat` DATETIME)  NO SQL
INSERT tbfav VALUES (null,fusrcod,fprpcod,fdat)$$

DROP PROCEDURE IF EXISTS `insfet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insfet` (IN `fdsc` VARCHAR(200))  NO SQL
INSERT tbfet VALUES(null,fdsc)$$

DROP PROCEDURE IF EXISTS `insloc`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insloc` (IN `lnam` VARCHAR(100), IN `lctycod` INT, IN `lcrd` VARCHAR(200))  NO SQL
INSERT  tbloc VALUES(null,lnam,lctycod,lcrd)$$

DROP PROCEDURE IF EXISTS `insprp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insprp` (IN `ptit` VARCHAR(100), IN `pagtcod` INT, IN `pprptypcod` INT, IN `padd` VARCHAR(200), IN `pcrd` VARCHAR(200), IN `psalsts` CHAR(1), IN `pdsc` VARCHAR(2000), IN `pprc` FLOAT, IN `plstdat` DATETIME, IN `pmanpiccod` INT, IN `psts` CHAR(1), OUT `cod` INT)  NO SQL
BEGIN
INSERT tbprp VALUES(null,ptit,pagtcod,pprptypcod,padd,
pcrd,psalsts,pdsc,pprc,plstdat,pmanpiccod,psts);

select last_insert_id() into cod;

END$$

DROP PROCEDURE IF EXISTS `insprpfet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insprpfet` (IN `pfetprpcod` INT, IN `pfetfetcod` INT, IN `pfetdsc` VARCHAR(2000))  NO SQL
INSERT tbprpfet VALUES(null, pfetprpcod,pfetfetcod,pfetdsc)$$

DROP PROCEDURE IF EXISTS `insprppic`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insprppic` (IN `ppicprpcod` INT, IN `ppicfil` VARCHAR(50), IN `ppicdsc` VARCHAR(2000), IN `ppicsts` CHAR(1))  NO SQL
INSERT tbprppic VALUES(null,ppicprpcod,ppicfil,ppicdsc,ppicsts)$$

DROP PROCEDURE IF EXISTS `insprptyp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insprptyp` (IN `ptypnam` VARCHAR(100))  NO SQL
INSERT tbprptyp VALUES(null,ptypnam)$$

DROP PROCEDURE IF EXISTS `insusr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insusr` (IN `unam` VARCHAR(50), IN `uphone` VARCHAR(50), IN `ueml` VARCHAR(100), IN `upwd` VARCHAR(100), IN `uregdat` DATETIME, IN `urol` CHAR(1), OUT `cod` INT)  NO SQL
BEGIN
INSERT tbusr VALUES(null, unam, uphone, ueml, upwd, uregdat, urol);
select last_insert_id() into cod;
END$$

DROP PROCEDURE IF EXISTS `logincheck`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `logincheck` (IN `eml` VARCHAR(100), IN `pwd` VARCHAR(100), OUT `cod` INT, OUT `rol` CHAR(1))  NO SQL
BEGIN
DECLARE actpwd varchar(100);
SELECT usrpwd FROM tbusr WHERE usreml=eml INTO @actpwd;
IF@actpwd IS null THEN
SET cod=-1;
SET rol='N';
ELSE
IF@actpwd=pwd THEN
SELECT usrrol FROM tbusr WHERE usreml=eml INTO rol;
if rol='A' then
select agtcod from tbagt,tbusr where agtusrcod=usrcod and usreml=eml into cod;
else
select usrcod from tbusr where usreml=eml into cod;
end if;
ELSE
SET cod=-2;
SET rol='N';
END IF;
END IF;
END$$

DROP PROCEDURE IF EXISTS `srcprp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `srcprp` (IN `lcod` INT, IN `sts` CHAR(1))  NO SQL
BEGIN
select prpcod,prptit,prpadd,prpcrd,prpdsc,prpprc,prplstdat, (select prppicfil from tbprppic where prppiccod=a.prpmanpiccod) pic,agtcod,
agtnam,(select ifnull( avg(agtrevscr),0) from tbagtrev where agtrevagtcod=b.agtcod) rev from tbprp a,tbagt b,tbprptyp where prpagtcod=agtcod and agtloccod=lcod 
and prpprptypcod=prptypcod and prpsalsts=sts and prpsts='A' order by prplstdat desc;
END$$

DROP PROCEDURE IF EXISTS `upcty`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `upcty` (IN `ccod` INT, IN `cnam` VARCHAR(100))  NO SQL
UPDATE tbcty set ctynam=cnam where ctycod=ccod$$

DROP PROCEDURE IF EXISTS `updagt`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updagt` (IN `acod` INT, IN `anam` VARCHAR(50), IN `aser` VARCHAR(100), IN `apic` VARCHAR(50), IN `aprf` VARCHAR(100))  NO SQL
update tbagt set agtnam=anam, agtser=aser,agtpic=apic,agtprf=aprf
 where agtcod=acod$$

DROP PROCEDURE IF EXISTS `updagtrev`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updagtrev` (IN `arevcod` INT, IN `arevagtcod` INT, IN `arevusrcod` INT, IN `arevprpcod` INT, IN `arevdat` DATETIME, IN `arevtit` VARCHAR(50), IN `arevdsc` VARCHAR(500), IN `arevscr` INT)  NO SQL
UPDATE tbagtrev set agtrevagtcod=arevagtcod,agtrevusrcod=arevusrcod,agtrevprpcod=arevprpcod,
agtrevdat=arevdat,agtrevtit=arevtit,agtrevdsc=arevdsc,agtrevscr=arevscr WHERE
agtrevcod=arevcod$$

DROP PROCEDURE IF EXISTS `updapp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updapp` (IN `acod` INT, IN `ausrcod` INT, IN `aprpcod` INT, IN `adat` DATETIME, IN `adsc` VARCHAR(200), IN `aphn` VARCHAR(100), IN `asts` CHAR(1))  NO SQL
UPDATE tbapp set appusrcod=ausrcod,appprpcod=aprpcod,appdat=adat,appdsc=adsc,appphn=aphn,
appsts=asts where appcod=acod$$

DROP PROCEDURE IF EXISTS `updfav`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updfav` (IN `fcod` INT, IN `fusrcod` INT, IN `fprpcod` INT, IN `fdat` DATETIME)  NO SQL
UPDATE tbfet set favusrcod=fusrcod,favprpcod=fprpcod,favdat=fdat WHERE favcod=fcod$$

DROP PROCEDURE IF EXISTS `updfet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updfet` (IN `fcod` INT, IN `fdsc` VARCHAR(200))  NO SQL
UPDATE tbfet SET fetdsc=fdsc WHERE fetcod=fcod$$

DROP PROCEDURE IF EXISTS `updloc`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updloc` (IN `lcod` INT, IN `lnam` VARCHAR(100), IN `lctycod` INT, IN `lcrd` VARCHAR(200))  NO SQL
UPDATE tbloc set locnam=lnam,locctycod=lctycod,loccrd=lcrd WHERE loccod=lcod$$

DROP PROCEDURE IF EXISTS `updprp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updprp` (IN `pcod` INT, IN `pmanpiccod` INT)  NO SQL
UPDATE tbprp set prpmanpiccod=pmanpiccod WHERE prpcod=pcod$$

DROP PROCEDURE IF EXISTS `updprpdet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updprpdet` (IN `pcod` INT, IN `ptit` VARCHAR(100), IN `pagtcod` INT, IN `pprptypcod` INT, IN `padd` VARCHAR(1000), IN `pcrd` VARCHAR(200), IN `psalsts ` CHAR(1), IN `pdsc ` VARCHAR(5000), IN `pprc` FLOAT)  NO SQL
BEGIN
update tbprp set prptit=ptit,prpagtcod=pagtcod,prpprptypcod=pprptypcod,prpadd=padd,
	prpcrd=pcrd,prpsalsts=psalsts,prpdsc=pdsc,prpprc=pprc where prpcod=pcod;
END$$

DROP PROCEDURE IF EXISTS `updprpfet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updprpfet` (IN `pfetcod` INT, IN `pfetprpcod` INT, IN `pfetfetcod` INT, IN `pfetdsc` VARCHAR(500))  NO SQL
UPDATE tbprpfet set prpfetprpcod=pfetprpcod,prpfetfetcod=pfetfetcod,prpfetdsc=pfetdsc where prpfetcod=pfetcod$$

DROP PROCEDURE IF EXISTS `updprppic`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updprppic` (IN `ppiccod` INT, IN `ppicprpcod` INT, IN `ppicfil` VARCHAR(50), IN `ppicdsc` VARCHAR(500), IN `ppicsts` CHAR(1))  NO SQL
UPDATE tbprppic set prppicprpcod=ppicprpcod,prppicfil=ppicfil,prppicdsc=ppicdsc,prppicsts=ppicsts
WHERE prppiccod=ppiccod$$

DROP PROCEDURE IF EXISTS `updprpsts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updprpsts` (IN `pcod` INT, IN `psts` CHAR(1))  NO SQL
BEGIN
update tbprp set prpsts=psts where prpcod=pcod;
END$$

DROP PROCEDURE IF EXISTS `updprptyp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updprptyp` (IN `ptypcod` INT, IN `ptypnam` VARCHAR(200))  NO SQL
UPDATE tbprptyp set prptypnam=ptypnam WHERE prptypcod=ptypcod$$

DROP PROCEDURE IF EXISTS `updusr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updusr` (IN `ucod` INT, IN `ueml` VARCHAR(100), IN `upwd` VARCHAR(100), IN `uregdat` DATETIME, IN `urol` CHAR(1))  NO SQL
UPDATE tbusr SET usreml=ueml,usrpwd=upwd,usrregdat=uregdat,usrrol=urol WHERE
usrcod=ucod$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbagt`
--

DROP TABLE IF EXISTS `tbagt`;
CREATE TABLE IF NOT EXISTS `tbagt` (
  `agtcod` int(11) NOT NULL AUTO_INCREMENT,
  `agtnam` varchar(100) NOT NULL,
  `agtloccod` int(11) NOT NULL,
  `agtser` varchar(100) NOT NULL,
  `agtpic` varchar(50) NOT NULL,
  `agtprf` varchar(10000) NOT NULL,
  `agtusrcod` int(11) NOT NULL,
  PRIMARY KEY (`agtcod`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbagt`
--

INSERT INTO `tbagt` (`agtcod`, `agtnam`, `agtloccod`, `agtser`, `agtpic`, `agtprf`, `agtusrcod`) VALUES
(1, 'Ajay Kumar', 1, 'Buying,Selling,Rental', 'a6.png', 'Real estate brokers and sales agents typically do the following.', 2),
(2, 'Rajesh', 2, 'Buying,Selling,Rental', 'a4.png', '10 Years Exp in Real estate', 3),
(3, 'Mr.sumit Rana', 3, 'Buying,Selling,Rental,Furnishing,Mortgaging,Estimation', 'qq.jpg', 'Buy, sell, and rent properties  ', 4),
(4, 'Mr.Amit', 4, 'Buying,Selling,Rental', 'a3.png', 'Sell,Rent,Purchase    ', 5),
(5, 'Mr.Anuj', 5, 'Buying,Selling,Rental,Furnishing', 'a5.png', '15 Years Exp in Sell, Rent ,Purchase', 6),
(6, 'Rajat', 3, 'Buying,Selling', '', 'hello', 10),
(7, 'Harish', 7, 'Buying,Selling,Rental,Furnishing', 'a1.jpg', 'I have intimate knowledge of the area and a strong desire to make my home, your home.', 11),
(8, 'Kapil', 7, 'Buying,Selling,Rental,Furnishing,Mortgaging', 'a2.png', 'I have helped over 500 families in the Lakeview area find their dream home.', 12),
(9, 'krish', 8, 'Buying,Selling,Rental', 'a4.png', 'I have intimate knowledge of the area and a strong desire to make your home.', 13),
(10, 'AC', 7, '', '', '', 17),
(11, 'Rohan', 9, '', '', '', 48);

-- --------------------------------------------------------

--
-- Table structure for table `tbagtrev`
--

DROP TABLE IF EXISTS `tbagtrev`;
CREATE TABLE IF NOT EXISTS `tbagtrev` (
  `agtrevcod` int(11) NOT NULL AUTO_INCREMENT,
  `agtrevagtcod` int(11) NOT NULL,
  `agtrevusrcod` int(11) NOT NULL,
  `agtrevprpcod` int(11) NOT NULL,
  `agtrevdat` datetime NOT NULL,
  `agtrevtit` varchar(50) NOT NULL,
  `agtrevdsc` varchar(2000) NOT NULL,
  `agtrevscr` int(11) NOT NULL,
  PRIMARY KEY (`agtrevcod`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbagtrev`
--

INSERT INTO `tbagtrev` (`agtrevcod`, `agtrevagtcod`, `agtrevusrcod`, `agtrevprpcod`, `agtrevdat`, `agtrevtit`, `agtrevdsc`, `agtrevscr`) VALUES
(1, 2, 7, 2, '2022-05-12 00:00:00', 'About Property', 'good and honest person', 3),
(2, 1, 7, 2, '2022-05-28 00:00:00', 'About Property', 'Good and honest person.....', 5),
(5, 4, 9, 8, '2022-06-22 00:00:00', '', '', 4),
(6, 4, 9, 8, '2022-06-22 00:00:00', 'good', 'ok', 4),
(7, 1, 18, 1, '2022-06-28 00:00:00', 'vbvjkl', 'fghj', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbapp`
--

DROP TABLE IF EXISTS `tbapp`;
CREATE TABLE IF NOT EXISTS `tbapp` (
  `appcod` int(11) NOT NULL AUTO_INCREMENT,
  `appusrcod` int(11) NOT NULL,
  `appprpcod` int(11) NOT NULL,
  `appname` varchar(50) NOT NULL,
  `appdat` datetime NOT NULL,
  `appdsc` varchar(2000) NOT NULL,
  `appphn` varchar(50) NOT NULL,
  `appsts` char(1) NOT NULL,
  PRIMARY KEY (`appcod`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbapp`
--

INSERT INTO `tbapp` (`appcod`, `appusrcod`, `appprpcod`, `appname`, `appdat`, `appdsc`, `appphn`, `appsts`) VALUES
(13, 64, 17, 'as', '2022-06-23 00:00:00', 'aaaaaaaaaaaaaaaaaaaaaaa', '8234567890', 'B'),
(14, 9, 8, 'rajat', '2022-06-27 00:00:00', 'i want to buy that property', '7404650301', 'B'),
(15, 18, 1, 'qwerty', '2022-07-09 00:00:00', 'qwertyuiop', '9876543210', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `tbcty`
--

DROP TABLE IF EXISTS `tbcty`;
CREATE TABLE IF NOT EXISTS `tbcty` (
  `ctycod` int(11) NOT NULL AUTO_INCREMENT,
  `ctynam` varchar(100) NOT NULL,
  PRIMARY KEY (`ctycod`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbcty`
--

INSERT INTO `tbcty` (`ctycod`, `ctynam`) VALUES
(1, 'Chandigarh'),
(2, 'Noida'),
(3, 'Delhi'),
(4, 'Ambala'),
(13, 'jaipur');

-- --------------------------------------------------------

--
-- Table structure for table `tbfav`
--

DROP TABLE IF EXISTS `tbfav`;
CREATE TABLE IF NOT EXISTS `tbfav` (
  `favcod` int(11) NOT NULL AUTO_INCREMENT,
  `favusrcod` int(11) NOT NULL,
  `favprpcod` int(11) NOT NULL,
  `favdat` datetime NOT NULL,
  PRIMARY KEY (`favcod`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbfav`
--

INSERT INTO `tbfav` (`favcod`, `favusrcod`, `favprpcod`, `favdat`) VALUES
(1, 7, 2, '2022-05-11 00:00:00'),
(2, 9, 4, '2022-06-04 00:00:00'),
(3, 9, 4, '2022-06-04 00:00:00'),
(4, 9, 4, '2022-06-04 00:00:00'),
(5, 9, 5, '2022-06-04 00:00:00'),
(6, 9, 5, '2022-06-04 00:00:00'),
(8, 9, 4, '2022-06-04 00:00:00'),
(9, 9, 4, '2022-06-04 00:00:00'),
(10, 6, 11, '2022-06-04 00:00:00'),
(11, 6, 11, '2022-06-04 00:00:00'),
(12, 6, 11, '2022-06-04 00:00:00'),
(13, 7, 3, '2022-06-09 00:00:00'),
(14, 7, 3, '2022-06-09 00:00:00'),
(15, 7, 3, '2022-06-09 00:00:00'),
(16, 7, 2, '2022-06-09 00:00:00'),
(17, 7, 2, '2022-06-09 00:00:00'),
(18, 7, 2, '2022-06-09 00:00:00'),
(19, 7, 9, '2022-06-09 00:00:00'),
(20, 7, 9, '2022-06-09 00:00:00'),
(21, 7, 9, '2022-06-14 00:00:00'),
(22, 7, 9, '2022-06-14 00:00:00'),
(23, 7, 9, '2022-06-14 00:00:00'),
(24, 7, 9, '2022-06-14 00:00:00'),
(25, 14, 16, '2022-06-16 00:00:00'),
(26, 47, 18, '2022-06-21 00:00:00'),
(27, 47, 18, '2022-06-21 00:00:00'),
(28, 47, 18, '2022-06-21 00:00:00'),
(29, 47, 18, '2022-06-21 00:00:00'),
(30, 47, 18, '2022-06-21 00:00:00'),
(31, 47, 18, '2022-06-21 00:00:00'),
(32, 47, 18, '2022-06-21 00:00:00'),
(33, 47, 18, '2022-06-21 00:00:00'),
(34, 47, 18, '2022-06-21 00:00:00'),
(35, 47, 18, '2022-06-21 00:00:00'),
(36, 47, 18, '2022-06-21 00:00:00'),
(37, 47, 18, '2022-06-21 00:00:00'),
(38, 9, 18, '2022-06-21 00:00:00'),
(39, 9, 10, '2022-06-21 00:00:00'),
(40, 9, 5, '2022-06-21 00:00:00'),
(41, 9, 5, '2022-06-21 00:00:00'),
(42, 9, 5, '2022-06-21 00:00:00'),
(43, 9, 5, '2022-06-21 00:00:00'),
(44, 9, 5, '2022-06-21 00:00:00'),
(45, 9, 5, '2022-06-21 00:00:00'),
(46, 9, 5, '2022-06-21 00:00:00'),
(47, 9, 5, '2022-06-21 00:00:00'),
(48, 9, 5, '2022-06-21 00:00:00'),
(49, 9, 5, '2022-06-21 00:00:00'),
(50, 9, 5, '2022-06-21 00:00:00'),
(51, 9, 5, '2022-06-21 00:00:00'),
(52, 9, 5, '2022-06-21 00:00:00'),
(53, 9, 5, '2022-06-21 00:00:00'),
(54, 9, 5, '2022-06-21 00:00:00'),
(55, 9, 5, '2022-06-21 00:00:00'),
(56, 9, 5, '2022-06-21 00:00:00'),
(57, 9, 5, '2022-06-21 00:00:00'),
(58, 9, 5, '2022-06-21 00:00:00'),
(59, 9, 5, '2022-06-21 00:00:00'),
(60, 9, 8, '2022-06-22 00:00:00'),
(61, 64, 17, '2022-06-23 00:00:00'),
(62, 64, 17, '2022-06-23 00:00:00'),
(63, 64, 17, '2022-06-23 00:00:00'),
(64, 64, 17, '2022-06-23 00:00:00'),
(65, 64, 17, '2022-06-23 00:00:00'),
(66, 64, 17, '2022-06-23 00:00:00'),
(67, 64, 17, '2022-06-23 00:00:00'),
(68, 64, 17, '2022-06-23 00:00:00'),
(69, 64, 17, '2022-06-23 00:00:00'),
(70, 64, 17, '2022-06-23 00:00:00'),
(71, 64, 17, '2022-06-23 00:00:00'),
(72, 64, 17, '2022-06-27 00:00:00'),
(73, 64, 17, '2022-06-27 00:00:00'),
(74, 64, 17, '2022-06-27 00:00:00'),
(75, 9, 5, '2022-06-27 00:00:00'),
(76, 9, 5, '2022-06-27 00:00:00'),
(77, 9, 18, '2022-06-27 00:00:00'),
(78, 18, 1, '2022-06-28 00:00:00'),
(79, 18, 1, '2022-06-28 00:00:00'),
(80, 81, 24, '2022-10-07 00:00:00'),
(81, 81, 24, '2022-10-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbfet`
--

DROP TABLE IF EXISTS `tbfet`;
CREATE TABLE IF NOT EXISTS `tbfet` (
  `fetcod` int(11) NOT NULL AUTO_INCREMENT,
  `fetdsc` varchar(200) NOT NULL,
  PRIMARY KEY (`fetcod`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbfet`
--

INSERT INTO `tbfet` (`fetcod`, `fetdsc`) VALUES
(1, 'Elevator'),
(2, 'SecuritySystem'),
(3, 'ModularKitchen');

-- --------------------------------------------------------

--
-- Table structure for table `tbloc`
--

DROP TABLE IF EXISTS `tbloc`;
CREATE TABLE IF NOT EXISTS `tbloc` (
  `loccod` int(11) NOT NULL AUTO_INCREMENT,
  `locnam` varchar(50) NOT NULL,
  `locctycod` int(11) NOT NULL,
  `loccrd` varchar(200) NOT NULL,
  PRIMARY KEY (`loccod`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbloc`
--

INSERT INTO `tbloc` (`loccod`, `locnam`, `locctycod`, `loccrd`) VALUES
(1, 'Sector 22c', 1, '(30.731824822700503, 76.802504249135)'),
(2, 'Sector 37', 1, '(30.72837959354804, 76.80363333398577)'),
(3, 'Sector-8', 2, '(28.3961454120783, 77.41129716493239)'),
(4, 'Sector-68', 2, '(28.35472661029758, 77.47518539766753)'),
(5, 'Karol Bagh', 3, '(28.651510251078495, 77.1956957930993)'),
(6, 'Old Delhi', 3, '(28.65416120298164, 77.2378542634827)'),
(7, 'Sector-8', 4, '(30.367386316422436, 76.77223175054627)'),
(8, 'Baldev Nagar', 4, '(30.39207573673578, 76.79824424819283)'),
(9, 'Vatika City Central Sector-10', 4, '(30.350341237113117, 76.78282412723746)'),
(11, 'Jaipur', 13, '(27.379546472466885, 75.45340087890625)'),
(12, 'Bagru', 13, '(26.846592369350812, 75.54678466796875)');

-- --------------------------------------------------------

--
-- Table structure for table `tbprp`
--

DROP TABLE IF EXISTS `tbprp`;
CREATE TABLE IF NOT EXISTS `tbprp` (
  `prpcod` int(11) NOT NULL AUTO_INCREMENT,
  `prptit` varchar(50) NOT NULL,
  `prpagtcod` int(11) NOT NULL,
  `prpprptypcod` int(11) NOT NULL,
  `prpadd` varchar(100) NOT NULL,
  `prpcrd` varchar(100) NOT NULL,
  `prpsalsts` char(1) NOT NULL,
  `prpdsc` varchar(2000) NOT NULL,
  `prpprc` float NOT NULL,
  `prplstdat` datetime NOT NULL,
  `prpmanpiccod` int(11) NOT NULL,
  `prpsts` char(1) NOT NULL,
  PRIMARY KEY (`prpcod`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbprp`
--

INSERT INTO `tbprp` (`prpcod`, `prptit`, `prpagtcod`, `prpprptypcod`, `prpadd`, `prpcrd`, `prpsalsts`, `prpdsc`, `prpprc`, `prplstdat`, `prpmanpiccod`, `prpsts`) VALUES
(1, 'AmanHomes', 1, 1, 'Opposite of Piccadily Mall sec 22c.', '(30.75059916401728, 76.65808203324676)', 'R', 'Lets get this out of the way right now. Great photography and video are definitely a priority when you are trying to sell a home.', 150000, '2022-05-17 00:00:00', 1, 'C'),
(2, 'DristiHomes', 1, 2, '121-M Sector-22 Chandigarh', '(30.774793534318977, 76.59628393754363)', 'P', 'The first thing that will grab them is the agents photography. Any potential buyer that likes the look of the house from the photographs .', 120000, '2022-05-16 00:00:00', 5, 'A'),
(3, 'RealHomes', 2, 1, 'karar Road Mohali sector 122', '(30.57321153799729, 76.64572241410613)', 'R', 'Rather than picking a specific age of home, try choosing a range of years. If you do not want a newer home, you can ask your agent to limit your search to homes built prior to a certain year.', 250000, '2022-04-02 00:00:00', -1, 'A'),
(4, 'AaradhyaGreen', 2, 1, 'Near of NCM Mohali sec 125.', '(30.810446469415545, 76.48092749223113)', 'R', 'Rather than picking a specific age of home, try choosing a range of years. If you do not want a newer home, you can ask your agent to limit your search to homes built prior to a certain year.', 3400000, '2022-05-02 00:00:00', 8, 'A'),
(5, 'AmaryaGreen', 3, 2, 'Sector-76 Noida', '(30.764304831564843, 76.54684546098113)', 'R', 'A 4 bhk flat is available for sale in noida sector-121. This north-East facing property is a part of aba cleo county. This is a ready to move in property that is 1-5 year old and has a super built-Up area of 2448 sq. Ft. The built-Up area is 2248 sq. Ft. The carpet area is 2100 sq.', 120000, '2022-05-04 00:00:00', 9, 'A'),
(6, 'TATA Eureka Park', 3, 3, 'Sector-8 Noida', '(28.433758003238022, 77.47655906105301)', 'P', 'about the project before taking any decision based on the contents displayed on the website 99acres.com. If you have any question or want to share feedback, feel free to write to us at projects-feedback@99acres.com. Trademarks belong to the respective owners.', 250000, '2022-05-19 00:00:00', 10, 'A'),
(7, 'Cleo County', 3, 2, 'Sec121, Noida', '(28.4852737554158, 77.51521667951103)', 'R', 'Boasting magnificent architecture and offering an experience of larger than life is the project of Cleo County in Sector 121, Noida offering 2640 residential apartments spread across 24 towers. The price of the apartments for sale are based on per sq.ft. that varies between Rs.4830 and Rs.23000.', 250000, '2022-05-17 00:00:00', 11, 'A'),
(8, 'AlokSociety', 4, 1, 'Sec121, Noida', '(28.439961573613378, 77.39664665287324)', 'P', 'Noida is wellconnected to the sectors and towns of Uttar Pradesh and Delhi by excellent and wide roads. Uttar Pradesh State Road Transport', 130000, '2022-05-25 00:00:00', 12, 'A'),
(9, 'DnyneshaResidency', 5, 2, 'Alandi Devachi, Delhi / NCR (All)', '(28.65456877883476, 77.2832225219213)', 'P', 'Just 5 minutes far from dnyaneshwar maharaj samadhi mandir.Nice location.All facility available near.School,hospitals and mit collage all things are available there. Basic needs amenities are available.', 150000, '2022-05-21 00:00:00', 13, 'A'),
(10, 'ResidentialApartment', 5, 1, ' Bhangare Colony, Patilnagar, Chikhali, , Delhi / NCR (All)', '', 'R', 'This property is free air circulated and calm side property. And located near indrayani river. Bus stand is 10 minutes from radhakrushna park. All families are familiar type and helful to each other. Power back up is provided.', 3000000, '2022-05-26 00:00:00', 14, 'A'),
(14, 'Easy Living', 7, 1, '#121 Sector-8 Near Huda Ground', '(30.3678568740056, 76.77412353513044)', 'R', 'A 2 Bedroom set for rent at very Good Price...', 20000, '2022-05-05 00:00:00', 16, 'A'),
(15, 'Homesphere', 7, 3, '12-N Sector-8 ', '(30.368108202304896, 76.77338642363696)', 'P', 'A 250 Square Yard Plot for sale..', 6000000, '2022-05-12 00:00:00', 19, 'A'),
(16, 'Pride And Property', 8, 1, '11-D Shakti Nagar Ambala', '(30.391511962055745, 30.79680888264733)', 'P', 'Shakti Nagar is well connected to the sectors and towns of Ambala  and kaithal by excellent and wide roads. \r\n', 5000000, '2022-06-15 00:00:00', 23, 'A'),
(17, 'Luxuna', 8, 1, '21-A Sector-8 Near Karan Place.', '(30.365992276249543, 76.77297999337196)', 'P', 'Rather than picking a specific age of home, try choosing a range of years. If you do not want a newer home, you can ask your agent to limit your search to homes built prior to a certain year.', 40000000, '2022-06-15 00:00:00', 20, 'A'),
(18, 'New Door', 8, 1, '934 Manav chowk Ambala city', '(30.364708220653434, 76.7669418247718)', 'R', 'This property is free air circulated and calm side property. And located near Manav chowk. Bus stand is 10 minutes from home. All families are familiar type and helful to each other. Power back up is provided. \r\n\r\n  \r\n', 240000, '2022-06-15 00:00:00', 22, 'A'),
(19, 'Evernest', 9, 3, '99 Baldev Nagar', '(30.391424111166288, 76.79791250184356)', 'P', 'This single-owner home sits on a large lot with mature trees. Itâ€™s ready for the next owners to bring it into the 21st century.', 6000000, '2022-06-27 00:00:00', -1, 'C'),
(20, 'Oak&Prime', 9, 1, '12/A Bladev Nagar Near Subzi Mandi', '(30.391971213839376, 76.79686043034104)', 'R', 'Best House with Large Roads and Park and Very Good People around their.', 5000000, '2022-06-27 00:00:00', 21, 'A'),
(21, 'Evernest', 9, 1, '99 Baldev Nagar', '(30.392042709545873, 76.79888763681852)', 'P', 'This single-owner home sits on a large lot with mature trees. Itâ€™s ready for the next owners to bring it into the 21st century.', 6900000, '2022-06-27 00:00:00', 12, 'A'),
(22, 'Atlantic Property', 9, 2, '9-C Baldev Nagar near chandigarh higway', '(30.391443035796073, 76.79582835327084)', 'P', 'Best Flats in whole Ambala..', 5000000, '2022-06-27 00:00:00', 10, 'A'),
(23, 'Fabulous Town', 1, 2, 'Sector-22 Chandigarh', '(30.774793534318977, 76.59628393754363)', 'P', 'A 4 bhk flat is available for sale This north-East facing property is a part of aba cleo county. This is a ready to move in property that is 1-5 year old and has a super built-Up area of 2448 sq. Ft. The built-Up area is 2248 sq. Ft. The carpet area is 2100 sq.', 120000, '2022-05-16 00:00:00', 5, 'A'),
(24, 'Ansal Property', 2, 1, '87-B Sector 37', '(30.739842965789176, 76.75220165308856)', 'P', 'Best property in that area visit it and you will happy ', 5000000, '2022-06-27 00:00:00', 14, 'A'),
(25, 'Alok Society', 4, 2, '11/v Sector 68', '(28.5316583089331, 77.4041162516259)', 'R', 'A very good flat available for rent at very cheap rate..', 20000, '2022-06-27 00:00:00', 10, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbprpfet`
--

DROP TABLE IF EXISTS `tbprpfet`;
CREATE TABLE IF NOT EXISTS `tbprpfet` (
  `prpfetcod` int(11) NOT NULL AUTO_INCREMENT,
  `prpfetprpcod` int(11) NOT NULL,
  `prpfetfetcod` int(11) NOT NULL,
  `prpfetdsc` varchar(2000) NOT NULL,
  PRIMARY KEY (`prpfetcod`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbprpfet`
--

INSERT INTO `tbprpfet` (`prpfetcod`, `prpfetprpcod`, `prpfetfetcod`, `prpfetdsc`) VALUES
(1, 1, 1, 'Great photography and video are definitely a priority when you are trying to sell a home.'),
(2, 2, 1, 'which means they will be reading the listing copy. If the homes description is lacking'),
(3, 3, 1, 'you can ask your agent to limit your search to homes built prior to a certain year.'),
(4, 4, 3, 'Great photography and video are definitely a priority when you are trying to sell a home.'),
(5, 5, 2, 'A 4 bhk flat is available for sale in noida sector-121. This north-East facing property is a part of aba cleo county. This is a ready to move in property that is 1-5 year old and has a super built-Up area of 2448 sq. Ft.'),
(6, 6, 3, 'A 4 bhk flat is available for sale in noida sector-121. This north-East facing property is a part of aba cleo county. This is a ready to move in property that is 1-5 year old and has a super built-Up area of 2448 sq. Ft.'),
(7, 7, 2, 'Great photography and video are definitely a priority when you are trying to sell a home.'),
(8, 8, 2, 'A 4 bhk flat is available for sale in noida sector-121. This is a ready to move in property that is 1-5 year old and has a super built-Up area of 2448 sq. Ft.'),
(9, 9, 2, '24 hours security'),
(10, 10, 3, 'japan technic kitchen'),
(15, 15, 1, 'You can add Anything'),
(16, 16, 2, 'High Security System in that area'),
(17, 17, 3, 'Nice house design and well decorative structure'),
(18, 18, 2, 'High Security System in that area'),
(19, 20, 2, 'Best in security system'),
(20, 21, 3, 'Very nice kitchen'),
(21, 22, 1, 'Elevator Availabe at Whole Building'),
(22, 24, 2, 'Best in everthing'),
(23, 25, 1, 'best in market');

-- --------------------------------------------------------

--
-- Table structure for table `tbprppic`
--

DROP TABLE IF EXISTS `tbprppic`;
CREATE TABLE IF NOT EXISTS `tbprppic` (
  `prppiccod` int(11) NOT NULL AUTO_INCREMENT,
  `prppicprpcod` int(11) NOT NULL,
  `prppicfil` varchar(50) NOT NULL,
  `prppicdsc` varchar(2000) NOT NULL,
  `prppicsts` char(1) NOT NULL,
  PRIMARY KEY (`prppiccod`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbprppic`
--

INSERT INTO `tbprppic` (`prppiccod`, `prppicprpcod`, `prppicfil`, `prppicdsc`, `prppicsts`) VALUES
(1, 1, '1.jpg', 'A property description is made up of 2 parts: key features and property description.', 'P'),
(2, 1, '23.mp4', 'A property description is made up of 2 parts: key features and property description.', 'V'),
(3, 1, '2.jpg', 'Tenants will primarily be interested in the practical information about your property. The snappy format enables them to know if your property meets their basic criteria quickly.', 'P'),
(4, 1, '3.jpg', ' The snappy format enables them to know if your property meets their basic criteria quickly.', 'P'),
(5, 2, '9.jpg', 'When buyers are looking at homes for sale on sites the first thing that will grab them is the agents photography. ', 'P'),
(6, 3, 'house7.jfif', 'Rather than picking a specific age of home, try choosing a range of years. If you do not want a newer home, you can ask your agent to limit your search to homes built prior to a certain year.', 'P'),
(7, 3, '12.jpg', ' If you do not want a newer home, you can ask your agent to limit your search to homes built prior to a certain year.', 'P'),
(8, 4, '20.jpg', 'Rather than picking a specific age of home, try choosing a range of years. If you do not want a newer home, you can ask your agent to limit your search to homes built prior to a certain year.', 'P'),
(9, 5, '13.jpg', 'A 4 bhk flat is available for sale in noida sector-121. This north-East facing property is a part of aba cleo county. ', 'P'),
(10, 6, '21.jpg', '. If you have any question or want to share feedback, feel free to write to us at projects-feedback@99acres.com. Trademarks belong to the respective owners.', 'P'),
(11, 7, '1.jpg', 'Boasting magnificent architecture and offering an experience of larger than life is the project of Cleo County in Sector 121, Noida offering 2640 ', 'P'),
(12, 8, '18.jpg', 'Noida is wellconnected to the sectors and towns of Uttar Pradesh and Delhi by excellent and wide roads. Uttar Pradesh State Road Transport', 'P'),
(13, 9, '25.jpg', 'Markal Road, Alandi Devachi, Delhi / NCR (All), India\r\nJust 5 minutes far from dnyaneshwar maharaj samadhi mandir.Nice location.All facility available near.School,hospitals and mit collage all things are available there. Basic needs amenities are available.', 'P'),
(14, 10, '26.jpg', 'This property is free air circulated and calm side property. And located near indrayani river. Bus stand is 10 minutes from radhakrushna park. All families are familiar type and helful to each other. Power back up is provided.', 'P'),
(16, 14, 'house1.jpg', 'Very Good House With less Price', 'P'),
(17, 15, 'plot.jpg', 'A 250 Square Yard Plot is availabe at very cheap cost', 'P'),
(19, 15, 'house2.jfif', 'Plot For Sale', 'P'),
(20, 15, 'house7.jfif', 'check this House....', 'P'),
(21, 15, 'house6.jfif', 'Great House with 3 Bedroom set and 2 Kitchen....', 'P'),
(22, 15, 'house5.jfif', 'very well and decorative houe', 'P'),
(23, 15, 'house4.jfif', 'House For Sale', 'P'),
(24, 15, 'house3.jfif', 'Easy Home ', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `tbprptyp`
--

DROP TABLE IF EXISTS `tbprptyp`;
CREATE TABLE IF NOT EXISTS `tbprptyp` (
  `prptypcod` int(11) NOT NULL AUTO_INCREMENT,
  `prptypnam` varchar(100) NOT NULL,
  PRIMARY KEY (`prptypcod`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbprptyp`
--

INSERT INTO `tbprptyp` (`prptypcod`, `prptypnam`) VALUES
(1, 'SocietyFlats'),
(2, 'BuilderFlats'),
(3, 'ResidentialPlots');

-- --------------------------------------------------------

--
-- Table structure for table `tbusr`
--

DROP TABLE IF EXISTS `tbusr`;
CREATE TABLE IF NOT EXISTS `tbusr` (
  `usrcod` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `usreml` varchar(50) NOT NULL,
  `usrpwd` varchar(50) NOT NULL,
  `usrregdat` datetime NOT NULL,
  `usrrol` char(1) NOT NULL,
  PRIMARY KEY (`usrcod`),
  UNIQUE KEY `usreml` (`usreml`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbusr`
--

INSERT INTO `tbusr` (`usrcod`, `name`, `phone`, `usreml`, `usrpwd`, `usrregdat`, `usrrol`) VALUES
(1, '', '0', 'admin@gmail.com', 'admin12', '2022-05-18 00:00:00', 'D'),
(2, '', '0', 'Ajay@gmail.com', '123456', '2022-05-15 00:00:00', 'A'),
(3, '', '0', 'Rajesh@gmail.com', 'qwerty', '2022-05-07 00:00:00', 'A'),
(4, '', '0', 'sumit@gmail.com', '234567', '2022-05-02 00:00:00', 'A'),
(5, '', '0', 'Amit@gmail.com', 'aaa123#', '2020-04-22 00:00:00', 'A'),
(6, '', '0', 'anuj@gmail.com', 'xyz123#', '2022-05-02 00:00:00', 'A'),
(7, '', '0', 'sandeep@gmail.com', 's123456', '2022-05-14 00:00:00', 'U'),
(9, '', '9764512340', 'Rajat@gmail.com', 'newpassword', '2022-06-04 00:00:00', 'U'),
(11, '', '0', 'harish@gmail.com', '%40819@', '2022-06-15 00:00:00', 'A'),
(12, '', '0', 'kapil2341@yahoo.com', '%15183@', '2022-06-15 00:00:00', 'A'),
(13, '', '0', 'krish@yahoo.com', '%80103@', '2022-06-15 00:00:00', 'A'),
(14, '', '0', '12345@1.nm', '123456789', '2022-06-16 00:00:00', 'U'),
(17, '', '0', 'ac@h.nm', '%92252@', '2022-06-16 00:00:00', 'A'),
(18, '', '0', '123456@gmail.com', '123456', '2022-06-16 00:00:00', 'U'),
(47, '', '0', 'r@gmail.com', '1234567', '2022-06-21 00:00:00', 'U'),
(48, '', '0', 'Rohan@gmail.com', '%57649@', '2022-06-22 00:00:00', 'A'),
(67, 'as', '1234567890', 'aaaq@gmail.com', '1234567', '2022-06-30 00:00:00', 'U'),
(68, 'asa', '1234567890', 'asw@gmail.com', '123456', '2022-07-03 00:00:00', 'U'),
(69, 'aqwe', '1234567890', 'qweqqq@gmail.com', 'qwerty', '2022-07-03 00:00:00', 'U'),
(70, 'as', '1234567890', 'aqa@yahoo.com', '123456', '2022-07-03 00:00:00', 'U'),
(71, 'qwe', '987654321', 'aaaaqa@yahoo.com', 'qwerty', '2022-07-03 00:00:00', 'U'),
(72, 'asw', '123456789', 'aabaqa@min.com', '123456', '2022-07-03 00:00:00', 'U'),
(73, 'as', '1234567890', 'aqa@outlook.com', 'sssssss', '2022-07-03 00:00:00', 'U'),
(74, 'aswe', '9012390911', 'aqa@tt.com', '1234567', '2022-07-03 00:00:00', 'U'),
(75, 'asw', '9123456789', 'aqa@as.co', '123456', '2022-07-03 00:00:00', 'U'),
(76, 'asw', '7891234577', 'aqa@zack.com', '123456', '2022-07-03 00:00:00', 'U'),
(77, 'Madhur ', '9416329046', 'madhurmehndiratta1996@gmail.com', 'madhur', '2022-07-03 00:00:00', 'U'),
(78, 'eas', '9012349999', 'aqw@ij.co', 'qwerty', '2022-07-03 00:00:00', 'U'),
(79, 'Rajat', '9878876123', 'rajat12@gmail.com', '99999999', '2022-07-05 00:00:00', 'U'),
(80, 'name', '9878987899', '12@j.ml', '123456', '2022-07-05 00:00:00', 'U'),
(81, 'aaaa', '9000000001', '0@0.com', '000000', '2022-10-07 00:00:00', 'U');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
