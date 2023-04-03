SELECT ROUND(SUM(d.pont*d.prioritas)/SUM(d.prioritas)) eredmeny,l.datum,l.id FROM dolgozok_ertekelesei d,lezart_ertekelesek l WHERE d.deleted=0 AND d.id_lezart_ertekelesek=l.id AND l.vezeto=@vezeto
GROUP BY d.id_lezart_ertekelesek
ORDER BY l.datum desc
