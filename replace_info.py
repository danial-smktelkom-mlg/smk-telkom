import os

# folder project
root_dir = "."

# daftar teks yang mau diganti
old_new = {
    "SMK BOE Malang": "SMK Telkom Malang",
    "Jl. Contoh Lama": "Jl. Danau Ranau, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 65139",
    "0812-0000-0000": "0812-2348-8999",
    "info@smk-boe.sch.id": "info@smktelkom-mlg.sch.id"
}

# loop semua file
for subdir, _, files in os.walk(root_dir):
    for file in files:
        if file.endswith((".html", ".php", ".js", ".md")):
            path = os.path.join(subdir, file)
            with open(path, "r", encoding="utf-8") as f:
                content = f.read()
            for old, new in old_new.items():
                content = content.replace(old, new)
            with open(path, "w", encoding="utf-8") as f:
                f.write(content)
print("✅ Selesai! Semua informasi sudah diganti.")

