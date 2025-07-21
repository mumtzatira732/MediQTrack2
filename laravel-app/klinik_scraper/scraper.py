from bs4 import BeautifulSoup
import pandas as pd

# Buka fail HTML yang kau dah simpan
with open("melaka2.html", encoding="utf-8") as f:
    soup = BeautifulSoup(f, "html.parser")

# Cari bahagian Melaka yang dah expand
melaka_div = soup.find("div", id="Melaka")
if not melaka_div:
    print("❌ Tak jumpa div dengan id='Melaka'.")
    exit()

# Cari table dalam bahagian Melaka
table = melaka_div.find("table")
if not table:
    print("❌ Tak jumpa jadual dalam bahagian Melaka.")
    exit()

# Extract rows dari jadual
data = []
rows = table.find_all("tr")
for row in rows:
    cols = row.find_all("td")
    cols = [ele.text.strip() for ele in cols]
    if cols:
        data.append(cols)

# Simpan ke CSV
df = pd.DataFrame(data, columns=["No", "Nama Klinik", "Alamat", "Telefon", "-", "-", "-"])
df = df[["Nama Klinik", "Alamat", "Telefon"]]  # ambil kolum penting sahaja
df.to_csv("klinik_melaka.csv", index=False, encoding="utf-8-sig")

print("✅ Siap! Data klinik Melaka dah disimpan ke 'klinik_melaka.csv'")
