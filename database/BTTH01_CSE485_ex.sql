
select ten_bhat 
from baiviet
where ma_tloai = 2
/*c2*/
select * from baiviet 
inner join tacgia
on baiviet.ma_tgia=tacgia.ma_tgia
where tacgia.ten_tgia="Nhacvietplus"
/*c3*/
select * from theloai
join baiviet
on theloai.ma_tloai=baiviet.ma_tloai
where count(baiviet.ma_tloai)=0
/*c4*/
select ma_bviet,tieude,ten_bhat,ten_tgia,ten_tloai,ngayviet
from baiviet
inner join tacgia on baiviet.ma_tgia=tacgia.ma_tgia
join theloai on theloai.ma_tloai=baiviet.ma_tloai
