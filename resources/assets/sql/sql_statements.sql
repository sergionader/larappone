CREATE VIEW vw_by_category as 
    SELECT
      types.id,
      types.name,
      sum(product_visit.amount) as y
    FROM visits, product_visit, types, types
        WHERE visits.id = product_visit.visit_id
        AND profiles.id = visits.profile_id
        AND types.id = profiles.type_id
        GROUP BY
        types.id,
        types.name
        ;

    --///////////////////////////////////////

create view vw_visits as select `visits`.`dt` AS `dt`,count(`visits`.`id`) AS `number_of_visits`,sum(`product_visit`.`amount`) AS `y` from (`visits` join `product_visit`) where ((`visits`.`id` = `product_visit`.`visit_id`) and (`product_visit`.`amount` = 0)) group by `visits`.`dt` order by `visits`.`dt`

create view `vw_sales` AS select `visits`.`dt` AS `dt`,count(`visits`.`id`) AS `number_of_sales`,sum(`product_visit`.`amount`) AS `y` from (`visits` join `product_visit`) where ((`visits`.`id` = `product_visit`.`visit_id`) and (`product_visit`.`amount` > 0)) group by `visits`.`dt` order by `visits`.`dt`;

create VIEW `vw_profiles` AS select `profiles`.`name` AS `Profile`,`types`.`name` AS `type`,`subtypes`.`name` AS `Subtype` from ((`profiles` join `types`) join `subtypes`) where ((`types`.`id` = `profiles`.`type_id`) and (`subtypes`.`id` = `profiles`.`subtype_id`));


SELECT  
        visits.id,
        visits.dt,
        visits.tm,
        profiles.name as profile,
        products.name as product,
        origins.name as origin,
        comment
FROM    visits, product_visit
        , products
        , profiles, origins
WHERE   visits.id = product_visit.visit_id
        AND products.id = product_visit.product_id
        AND profiles.id = visits.profile_id
        AND origins.id = visits.origin_id
        limit 10




SELECT  
        types.id,
        types.name as category,
        subtypes.name,
        sum(product_visit.amount) AS y
FROM visits, product_visit, types, types, ages
WHERE visits.id = product_visit.visit_id
        AND profiles.id = visits.profile_id
        AND types.id = profiles.type_id
        AND subtypes.id = profiles.subtype_id
        AND profiles.type_id = 1
GROUP BY  types.id, types.name, subtypes.name



--TYPES and SUBTYPES
SELECT  
        types.name as type, 
        subtypes.name as subtype,
        sum(product_visit.amount) AS y
FROM visits, product_visit, profiles, types, subtypes
WHERE visits.id = product_visit.visit_id
        AND profiles.id = visits.profile_id
        AND types.id = profiles.type_id
        AND subtypes.id = profiles.subtype_id
GROUP BY   types.name, subtypes.name

--TYPES 
SELECT  
        types.id,
        types.name,
        sum(product_visit.amount) AS y
FROM visits, product_visit, profiles, types
WHERE visits.id = product_visit.visit_id
        AND profiles.id = visits.profile_id
        AND types.id = profiles.type_id
GROUP BY types.id, types.name
ORDER BY types.name
-- GROUP BY types.name
--  WITH ROLLUP
        -- ORDER BY types.name

--SUBTYPES
SELECT  
types.id as type_id,
subtypes.id as subtypes_id,
types.name as type, 
subtypes.name as subtype,
sum(product_visit.amount) AS y
FROM visits, product_visit, profiles, types, subtypes
WHERE visits.id = product_visit.visit_id
AND profiles.id = visits.profile_id
AND types.id = profiles.type_id
AND subtypes.id = profiles.subtype_id
GROUP BY   types.name, subtypes.name
ORDER BY type, subtype

--SUBTYPES & PRODUCTS
                SELECT  
                types.id as type_id,   
                subtypes.id as subtype_id,   
                types.name as type, 
                subtypes.name as subtype,
                product_visit.product_id as product_id,
                -- profiles.name as profile,
                products.name as product,
                sum(product_visit.amount) AS y
                FROM 
                visits, product_visit, products, profiles
                ,types, subtypes
                WHERE 
                visits.id = product_visit.visit_id
                AND products.id = product_visit.product_id
                AND profiles.id = visits.profile_id
                AND types.id = profiles.type_id
                AND subtypes.id = profiles.subtype_id
                AND types.id = 1
                GROUP BY  profiles.name, products.name
                ORDER BY  profiles.name, products.name


SELECT count(visits.id) as visits
FROM visits, product_visit
WHERE
    visits.id = product_visit.visit_id
    AND visits.dt='2017-10-10'
    AND product_visit.amount=0;


SELECT visits.id, count(visits.id) as ids, sum(product_visit.amount) as y
FROM visits, product_visit
WHERE
    visits.id = product_visit.visit_id
    AND (visits.dt between '2017-01-10' and '2017-10-20')
GROUP BY visits.id


select (SELECT visits.dt, count(visits.id) as number_of_sales, sum(product_visit.amount) as y
                        FROM visits, product_visit
                        WHERE
                            visits.id = product_visit.visit_id
                            AND (visits.dt between '2017/01/01' and '2017/10/01')  
                         AND product_visit.amount>0
                        GROUP BY dt) as SALES,
                 
(SELECT visits.dt, count(visits.id) as number_of_visits, sum(product_visit.amount) as y
                        FROM visits, product_visit
                        WHERE
                            visits.id = product_visit.visit_id
                            AND (visits.dt between '2017/01/01' and '2017/10/01')  
                         AND product_visit.amount=0
                        GROUP BY dt) as VISITS


create view vw_visits as
SELECT visits.dt, count(visits.id) as number_of_visits, sum(product_visit.amount) as y
FROM visits, product_visit
WHERE
        visits.id = product_visit.visit_id

AND product_visit.amount=0
GROUP BY dt
ORDER BY dt

--AND (visits.dt between '2017/01/01' and '2017/10/01')  
create view vw_sales as
SELECT visits.dt, count(visits.id) as number_of_sales, sum(product_visit.amount) as y
FROM visits, product_visit
WHERE
        visits.id = product_visit.visit_id

AND product_visit.amount>0
GROUP BY dt
ORDER BY dt
--AND (visits.dt between '2017/01/01' and '2017/10/01')  

select  vw_visits.dt, vw_visits.number_of_visits as visits, 
        vw_sales.number_of_sales as sales, 
        (vw_visits.number_of_visits + vw_sales.number_of_sales) as total, 
        vw_sales.number_of_sales/(vw_visits.number_of_visits + vw_sales.number_of_sales) as rate,
        IF(vw_visits.number_of_visits<vw_sales.number_of_sales,'YES','no') as test
from vw_visits, vw_sales
where vw_visits.dt = vw_sales.dt
AND IF(vw_visits.number_of_visits<vw_sales.number_of_sales,'YES','no') = 'YES'
AND (vw_visits.dt between '2016/01/01' and '2017/12/31')  

        SELECT  vw_visits.dt
        FROM vw_visits, vw_sales
        WHERE vw_visits.dt = vw_sales.dt
        AND (vw_visits.dt between '2016/01/01' and '2016/01/31')  
        ORDER BY vw_visits.dt

select dt, count(dt) from vw_profiles 
where (dt between '2017/01/01' and '2017/12/31')  
group by dt


SELECT  
        origins.name as origin, 
        products.name as product,
        sum(product_visit.amount) AS y
FROM visits, product_visit, products, origins
WHERE       visits.id = product_visit.visit_id
        AND products.id = product_visit.product_id
        AND origins.id = visits.origin_id  
        AND product_visit.amount>0     
        AND origins.id!=10 
GROUP BY   origins.name, products.name
LIMIT 10

create view vw_temp as 
        SELECT  
                origins.name as Country, 
                sum(product_visit.amount) AS Sales
        FROM visits, product_visit, origins
        WHERE       visits.id = product_visit.visit_id
                AND origins.id = visits.origin_id  
                AND product_visit.amount>0                     
        GROUP BY   origins.name
 SELECT  
                origins.name as Country, 
                sum(product_visit.amount) AS Sales
        FROM visits, product_visit, origins
        WHERE       visits.id = product_visit.visit_id
                AND origins.id = visits.origin_id  
                AND product_visit.amount>0                     
        GROUP BY   origins.name

More from USA< BRA and Puerto Rico

CREATE VIEW vw_profiles as
select profiles.name as Profile, types.name as type,  subtypes.name as Subtype
from profiles, types, subtypes
WHERE
types.id = profiles.type_id
AND subtypes.id = profiles.subtype_id


-- GET visits and products

SELECT visits.id, product_visit.product_id 
        FROM visits, product_visit
        WHERE
        visits.id = product_visit.visit_id

SELECT visits.id, count(product_visit.product_id) as count_prod
        FROM visits, product_visit
        WHERE
        visits.id = product_visit.visit_id
        Group by visits.id
        having count(count_prod)>1
        order by count_prod desc

    
-- // temp / draft
    SELECT  
        visits.id,
        visits.dt,
        visits.tm,
        product_visit.amount
FROM    visits, product_visit

WHERE   visits.id = product_visit.visit_id
        and profile_id in (4)
        and (visits.dt between '2017/11/01' and '2017/11/30')  
 SELECT
            types.id as type_id,
            types.name as type,    
            DATE_FORMAT(visits.dt, '%m') AS month_idx,
            DATE_FORMAT(visits.dt, '%b') AS month,
            DATE_FORMAT(visits.dt, '%Y') AS year,
            ROUND(sum(product_visit.amount)) AS y
        FROM    visits, product_visit, profiles, types 
        WHERE 
            visits.id       = product_visit.visit_id
            AND profiles.id = visits.profile_id
            AND types.id    = profiles.type_id           
            AND product_visit.amount>0
             and (visits.dt between '2017/01/01' and '2017/12/30')             
        GROUP BY year, month_idx, month, types.name, types.id
        ORDER BY year,types.name, month_idx;