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

--j
DELIMITER //
CREATE PROCEDURE sp_DSBaiViet(IN ten_theloai VARCHAR(50))
BEGIN
    DECLARE ma_tloai INT;
    
    -- Kiểm tra thể loại có tồn tại hay không
    SELECT ma_tloai INTO ma_tloai
    FROM theloai
    WHERE ten_tloai = ten_theloai;
    IF ma_tloai IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Thể loại không tồn tại';
    ELSE
        -- Liệt kê bài viết của thể loại
        SELECT baiviet.ma_bviet, baiviet.tieude AS ten_bviet, baiviet.ten_bhat, tacgia.ten_tgia, baiviet.ngayviet
        FROM baiviet
        JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
        WHERE baiviet.ma_tloai = ma_tloai;
    END IF;
END//
DELIMITER ;
--k
ALTER TABLE theloai
ADD SLBaiViet INT DEFAULT 0;
DELIMITER //
CREATE TRIGGER tg_CapNhatTheLoai
AFTER INSERT ON baiviet
FOR EACH ROW
BEGIN
    UPDATE theloai
    SET SLBaiViet = SLBaiViet + 1
    WHERE ma_tloai = NEW.ma_tloai;
END//
DELIMITER ;
--l
CREATE TABLE Users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
