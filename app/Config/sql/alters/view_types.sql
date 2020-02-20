drop view view_types;
create view view_types as
select `b`.`hostname` AS `hostname`,`b`.`sitename` AS `sitename`,`a`.`id` AS `id`,`a`.`siteid` AS `siteid`,
    `a`.`typename` AS `typename`, a.typealias, `a`.`url` AS `url`,`a`.`status` AS `status`,`c`.`price` AS `price`,
    `c`.`earning` AS `earning`,`c`.`start` AS `start`,`c`.`end` AS `end` 
from ((`types` `a` join `sites` `b`) join `fees` `c`) 
where ((`a`.`siteid` = `b`.`id`) and (`a`.`id` = `c`.`typeid`))