INSERT into student (id, password, f_name, l_name, sex, program, country) VALUES(
   1,
   "1",
   "Arnold",
   "Makonye",
   "Male",
   103,
   1
);
INSERT into student (id, password, f_name, l_name, sex, program, country) VALUES(
   2,
   "2",
   "Mercy",
   "Namfukwe",
   "Female",
   103,
   10
);
INSERT into student (id, password, f_name, l_name, sex, program, country) VALUES(
   3,
   "3",
   "Christabel",
   "Kunda",
   "Female",
   103,
   50
);
INSERT into student (id, password, f_name, l_name, sex, program, country) VALUES(
   4,
   "4",
   "Mwiche",
   "Nakamba",
   "Female",
   103,
   67
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
