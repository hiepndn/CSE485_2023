Use BTTH01_CSE485

--a
select ten_bhat 
from baiviet
where ma_tloai = 2

--b
select * from baiviet 
inner join tacgia
on baiviet.ma_tgia=tacgia.ma_tgia
where tacgia.ten_tgia= N'Nhacvietplus'

--c
select * from theloai
where ten_tloai not in ( select theloai.ten_tloai from theloai
                         inner join baiviet
                         on theloai.ma_tloai=baiviet.ma_tloai
                         group by theloai.ten_tloai )

--d
select ma_bviet,tieude,ten_bhat,ten_tgia,ten_tloai,ngayviet
from baiviet
inner join tacgia on baiviet.ma_tgia=tacgia.ma_tgia
join theloai on theloai.ma_tloai=baiviet.ma_tloai

--e
With max_The_loai as (
	select theloai.ten_tloai, count(theloai.ten_tloai) as soluong,
		   DENSE_RANK() over(order by count(theloai.ten_tloai) desc)  as thuhang
	from theloai 
	inner join baiviet on theloai.ma_tloai = baiviet.ma_tloai
	group by theloai.ten_tloai
) 
select ten_tloai, soluong
from max_The_loai
where thuhang = 1

--f
Select TOP 2 ten_tgia , Count(ma_bviet) AS Sobaiviet
From tacgia join baiviet on tacgia.ma_tgia = baiviet.ma_tgia
Group by ten_tgia
Order by Sobaiviet DESC;

--g
Select tieude from baiviet
Where ten_bhat LIKE '%yêu%'
   OR ten_bhat LIKE '%thương%'
   OR ten_bhat LIKE '%anh%'
   OR ten_bhat LIKE '%em%';

--h
Select tieude from baiviet
Where tieude LIKE '%yêu%'
   OR tieude LIKE '%thương%'
   OR tieude LIKE '%anh%'
   OR tieude LIKE '%em%'
   OR ten_bhat LIKE '%yêu%'
   OR ten_bhat LIKE '%thương%'
   OR ten_bhat LIKE '%anh%'
   OR ten_bhat LIKE '%em%';

--i
Create View vw_Music AS
(Select ten_tloai, ten_tgia
from tacgia 
join baiviet on baiviet.ma_tgia= tacgia.ma_tgia
join theloai on baiviet.ma_tloai= theloai.ma_tloai)


