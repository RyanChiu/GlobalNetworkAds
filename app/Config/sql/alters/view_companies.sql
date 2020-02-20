 CREATE VIEW `view_companies` AS 
 select 
    count(`a`.`id`) AS `agenttotal`,`a`.`companyid` AS `companyid`,`b`.`officename` AS `officename`,
    `c`.`username` AS `username`,`c`.`username4m` AS `username4m`,`c`.`originalpwd` AS `originalpwd`,
    `c`.`regtime` AS `regtime`,`c`.`status` AS `status`,`c`.`online` AS `online`,`b`.`banknamebdo` AS `banknamebdo`,
    `b`.`bankaccount` AS `bankaccount`,`b`.`banknum` AS `banknum`,`b`.`payeename` AS `payeename`,
    `b`.`swiftcode` AS `swiftcode`,`b`.`man1stname` AS `man1stname`,`b`.`manlastname` AS `manlastname`,
    `b`.`manemail` AS `manemail`,`b`.`skypetelegram` AS `skypetelegram` 
from `agents` `a`, `companies` `b`, `accounts` `c` 
where ((`a`.`companyid` = `b`.`id`) and (`b`.`id` = `c`.`id`)) 
group by `a`.`companyid` 
union 
select 
    0 AS `0`,`b`.`id` AS `companyid`,`b`.`officename` AS `officename`,`c`.`username` AS `username`,
    `c`.`username4m` AS `username4m`,`c`.`originalpwd` AS `originalpwd`,`c`.`regtime` AS `regtime`,`c`.`status` AS `status`,
    `c`.`online` AS `online`,`b`.`banknamebdo` AS `banknamebdo`,`b`.`bankaccount` AS `bankaccount`,`b`.`banknum` AS `banknum`,
    `b`.`payeename` AS `payeename`,`b`.`swiftcode` AS `swiftcode`,`b`.`man1stname` AS `man1stname`,
    `b`.`manlastname` AS `manlastname`,`b`.`manemail` AS `manemail`,`b`.`skypetelegram` AS `skypetelegram` 
from `companies` `b`, `accounts` `c` 
where ((`b`.`id` = `c`.`id`) and (not(`b`.`id` in (select distinct `agents`.`companyid` AS `companyid` from `agents`))))