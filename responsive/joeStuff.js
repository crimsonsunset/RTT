SELECT [Copy Of WORK_Informz_PMD_Final].Email, Right([Email],3) AS Expr1, Count([Expr1]) AS Expr2, Null AS NewCountry
FROM [Copy Of WORK_Informz_PMD_Final]
GROUP BY [Copy Of WORK_Informz_PMD_Final].Email, Right([Email],3), Null;