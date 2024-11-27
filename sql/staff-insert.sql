INSERT into staff VALUES(
   1,
   "1",
   "Nelson",
   "Musonda",
   "Male"
);
INSERT into staff VALUES(
   2,
   "2",
   "Arnold",
   "Makonye",
   "Male"
);


INSERT into staff VALUES(
   3333333333,
   "3333333333",
   "Christabel",
   "Kunda",
   "Female"
);

INSERT into staff VALUES(
   4444444444,
   "4444444444",
   "Mwiche",
   "Nakamba",
   "Female"
);


select
   stu.id as id,
   stu.f_name as fname,
   stu.l_name as lname,
   sch.name as school,
   prg.name as program,
   con.name as country
From
   student stu
join
   program prg ON stu.program = prg.id
join
   school sch ON prg.school = sch.id
join
   country con on stu.country = con.id;
