create view view_new_members as
SELECT a.*, b.officename
FROM `accounts` a, companies b, agents c
WHERE a.status = -1 and c.companyid = b.id and a.id = c.id
UNION
SELECT a.*, "-" as officename
FROM accounts a, companies b
where a.status = -1 and b.id = a.id