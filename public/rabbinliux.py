# -*- coding: utf-8 -*-
import sys
import json
import os


f = open('/var/www/rabbin-similiarity/public/dict.json')
mydict = json.load(f)

# stopword tambahan

more_stopword = ['a', 'adanya', 'adapun', 'agaknya', 'akankah', 'akhir', 'akhiri', 'akhirnya', 'aku', 'akulah', 'amatlah', 'andalah', 'antar', 'antaranya', 'apa', 'apaan', 'apabila', 'apatah', 'arti', 'artinya', 'asal', 'asalkan', 'atas', 'ataukah', 'ataupun', 'awal', 'awalnya', 'b', 'bagai', 'bagaikan', 'bagaimana', 'bagaimanakah', 'bagainamakah', 'bagian', 'bahkan', 'bahwasannya', 'bahwasanya', 'baik', 'baiklah', 'bakal', 'bakalan', 'balik', 'banyak', 'bapak', 'baru', 'bawah', 'beberapa', 'begini', 'beginian', 'beginikah', 'beginilah', 'begitukah', 'begitulah', 'begitupun', 'bekerja', 'belakang', 'belakangan', 'belumlah', 'benar', 'benarkah', 'benarlah', 'berada', 'berakhir', 'berakhirlah', 'berakhirnya', 'berapa', 'berapakah', 'berapalah', 'berapapun', 'berarti', 'berawal', 'berbagai', 'berdatangan', 'beri', 'berikan', 'berikut', 'berikutnya', 'berjumlah', 'berkali-kali', 'berkata', 'berkehendak', 'berkeinginan', 'berkenaan', 'berlainan', 'berlalu', 'berlangsung', 'berlebihan', 'bermacam', 'bermacam-macam', 'bermaksud', 'bermula', 'bersama', 'bersama-sama', 'bersiap', 'bersiap-siap', 'bertanya', 'bertanya-tanya', 'berturut', 'berturut-turut', 'bertutur', 'berujar', 'berupa', 'besar', 'betul', 'betulkah', 'biasa', 'biasanya', 'bila', 'bilakah', 'bisakah', 'bolehkah', 'bolehlah', 'buat', 'bukan', 'bukankah', 'bukanlah', 'bukannya', 'bulan', 'bung', 'c', 'cara', 'caranya', 'cukup', 'cukupkah', 'cukuplah', 'cuma', 'd', 'datang', 'dekat', 'demikianlah', 'depan', 'diakhiri', 'diakhirinya', 'dialah', 'diantara', 'diantaranya', 'diberi', 'diberikan', 'diberikannya', 'dibuat', 'dibuatnya', 'didapat', 'didatangkan', 'digunakan', 'diibaratkan', 'diibaratkannya', 'diingat', 'diingatkan', 'diinginkan', 'dijawab', 'dijelaskan', 'dijelaskannya', 'dikarenakan', 'dikatakan', 'dikatakannya', 'dikerjakan', 'diketahui', 'diketahuinya', 'dikira', 'dilakukan', 'dilalui', 'dilihat', 'dimaksud', 'dimaksudkan', 'dimaksudkannya', 'dimaksudnya', 'diminta', 'dimintai', 'dimisalkan', 'dimulai', 'dimulailah', 'dimulainya', 'dimungkinkan', 'dini', 'dipastikan', 'diperbuat', 'diperbuatnya', 'dipergunakan', 'diperkirakan', 'diperlihatkan', 'diperlukan', 'diperlukannya', 'dipersoalkan', 'dipertanyakan', 'dipunyai', 'diri', 'dirinya', 'disampaikan', 'disebut', 'disebutkan', 'disebutkannya', 'disini', 'disinilah', 'ditambahkan', 'ditandaskan', 'ditanya', 'ditanyai', 'ditanyakan', 'ditegaskan', 'ditujukan', 'ditunjuk', 'ditunjuki', 'ditunjukkan', 'ditunjukkannya', 'ditunjuknya', 'dituturkan', 'dituturkannya', 'diucapkan', 'diucapkannya', 'diungkapkan', 'dong', 'dulu', 'e', 'empat', 'enak', 'enggak', 'enggaknya', 'entah', 'entahlah', 'f', 'g', 'gunakan', 'h', 'hadap', 'hai', 'halo', 'hallo', 'hampir', 'hanyalah', 'hari', 'haruslah', 'harusnya', 'helo', 'hello', 'hendak', 'hendaklah', 'hendaknya', 'hingga', 'i', 'ialah', 'ibarat', 'ibaratkan', 'ibaratnya', 'ibu', 'ikut', 'ingat', 'ingat-ingat', 'inginkah', 'inginkan', 'inikah', 'inilah', 'itukah', 'j', 'jadi', 'jadilah', 'jadinya', 'jangan', 'jangankan', 'janganlah', 'jauh', 'jawab', 'jawaban', 'jawabnya', 'jelas', 'jelaskan', 'jelaslah', 'jelasnya', 'jikalau', 'jumlah', 'jumlahnya', 'justru', 'k', 'kadar', 'kala', 'kalau', 'kalaulah', 'kalaupun', 'kali', 'kalian', 'kamilah', 'kamu', 'kamulah', 'kan', 'kapan', 'kapankah', 'kapanpun', 'karenanya', 'kasus', 'kata', 'katakan', 'katakanlah', 'katanya', 'keadaan', 'kebetulan', 'kecil', 'kedua', 'keduanya', 'keinginan', 'kelamaan', 'kelihatan', 'kelihatannya', 'kelima', 'keluar', 'kemudian', 'kemungkinan', 'kemungkinannya', 'kena', 'kepadanya', 'keras', 'kerja', 'kesampaian', 'keseluruhan', 'keseluruhannya', 'keterlaluan', 'khusus', 'khususnya', 'kini', 'kinilah', 'kira', 'kira-kira', 'kiranya', 'kitalah', 'kok', 'kurang', 'l', 'lagian', 'lah', 'lainnya', 'laku', 'lalu', 'lama', 'lamanya', 'langsung', 'lanjut', 'lanjutnya', 'lebih', 'lewat', 'lihat', 'lima', 'luar', 'm', 'macam', 'makanya', 'makin', 'maksud', 'malah', 'malahan', 'mampu', 'mampukah', 'mana', 'manakala', 'manalagi', 'masa', 'masalah', 'masalahnya', 'masihkah', 'masing', 'masing-masing', 'masuk', 'mata', 'mau', 'maupun', 'melakukan', 'melalui', 'melihat', 'melihatnya', 'memang', 'memastikan', 'memberi', 'memberikan', 'membuat', 'memerlukan', 'memihak', 'meminta', 'memintakan', 'memisalkan', 'memperbuat', 'mempergunakan', 'memperkirakan', 'memperlihatkan', 'mempersiapkan', 'mempersoalkan', 'mempertanyakan', 'mempunyai', 'memulai', 'memungkinkan', 'menaiki', 'menambahkan', 'menandaskan', 'menanti', 'menanti-nanti', 'menantikan', 'menanya', 'menanyai', 'menanyakan', 'mendapat', 'mendapatkan', 'mendatang', 'mendatangi', 'mendatangkan', 'menegaskan', 'mengakhiri', 'mengatakan', 'mengatakannya', 'mengenai', 'mengerjakan', 'mengetahui', 'menggunakan', 'menghendaki', 'mengibaratkan', 'mengibaratkannya', 'mengingat', 'mengingatkan', 'menginginkan', 'mengira', 'mengucapkan', 'mengucapkannya', 'mengungkapkan', 'menjadi', 'menjawab', 'menjelaskan', 'menuju', 'menunjuk', 'menunjuki', 'menunjukkan', 'menunjuknya', 'menuturkan', 'menyampaikan', 'menyangkut', 'menyatakan', 'menyebutkan', 'menyeluruh', 'menyiapkan', 'merasa', 'merekalah', 'merupakan', 'meski', 'meskipun', 'meyakini', 'meyakinkan', 'minta', 'mirip', 'misal', 'misalkan', 'misalnya', 'mohon', 'mula', 'mulai', 'mulailah', 'mulanya', 'mungkin', 'mungkinkah', 'n', 'nah', 'naik', 'nantinya', 'nya', 'nyaris', 'nyata', 'nyatanya', 'o', 'olehnya', 'orang', 'p', 'padahal', 'padanya', 'pak', 'paling', 'panjang', 'pantas', 'pastilah', 'penting', 'pentingnya', 'per', 'percuma', 'perlu', 'perlukah', 'perlunya', 'pernah', 'persoalan', 'pertama', 'pertama-tama', 'pertanyaan', 'pertanyakan', 'pihak', 'pihaknya', 'pukul', 'punya', 'q', 'r', 'rasa', 'rasanya', 'rupa', 'rupanya', 's', 'saatnya', 'sajalah', 'salam', 'saling', 'sama', 'sama-sama', 'sampai-sampai', 'sampaikan', 'sana', 'sangat', 'sangatlah', 'sangkut', 'satu', 'sayalah', 'se', 'sebabnya', 'sebagaimana', 'sebagainya', 'sebagian', 'sebaik', 'sebaik-baiknya', 'sebaiknya', 'sebaliknya', 'sebanyak', 'sebegini', 'sebegitu', 'sebelumnya', 'sebenarnya', 'seberapa', 'sebesar', 'sebisanya', 'sebuah', 'sebut', 'sebutlah', 'sebutnya', 'secukupnya', 'sedang', 'sedemikian', 'sedikit', 'sedikitnya', 'seenaknya', 'segala', 'segalanya', 'segera', 'seingat', 'sejak', 'sejauh', 'sejenak', 'sejumlah', 'sekadar', 'sekadarnya', 'sekali', 'sekali-kali', 'sekalian', 'sekaligus', 'sekalipun', 'sekarang', 'sekaranglah', 'sekecil', 'seketika', 'sekiranya', 'sekitarnya', 'sekurang-kurangnya', 'sekurangnya', 'sela', 'selaku', 'selalu', 'selama', 'selama-lamanya', 'selamanya', 'selanjutnya', 'seluruh', 'seluruhnya', 'semacam', 'semakin', 'semampu', 'semampunya', 'semasa', 'semasih', 'semata', 'semata-mata', 'semaunya', 'semisal', 'semisalnya', 'sempat', 'semua', 'semuanya', 'semula', 'sendiri', 'sendirian', 'sendirinya', 'seolah-olah', 'seorang', 'sepanjang', 'sepantasnya', 'sepantasnyalah', 'seperlunya', 'sepertinya', 'sepihak', 'sering', 'seringnya', 'serupa', 'sesaat', 'sesama', 'sesampai', 'sesegera', 'sesekali', 'seseorang', 'sesuatunya', 'sesudahnya', 'setempat', 'setengah', 'setiba', 'setibanya', 'setidak-tidaknya', 'setinggi', 'seusai', 'sewaktu', 'siap', 'siapa', 'siapakah', 'siapapun', 'sini', 'sinilah', 'soal', 'soalnya', 'suatu', 'sudahkah', 'sudahlah', 't', 'tadi', 'tadinya', 'tahu', 'tak', 'tambah', 'tambahnya', 'tampak', 'tampaknya', 'tandas', 'tandasnya', 'tanya', 'tanyakan', 'tanyanya', 'tegas', 'tegasnya', 'tempat', 'tentulah', 'tentunya', 'tepat', 'terakhir', 'terasa', 'terbanyak', 'terdahulu', 'terdapat', 'terdiri', 'terhadapnya', 'teringat', 'teringat-ingat', 'terjadi', 'terjadilah', 'terjadinya', 'terkira', 'terlalu', 'terlebih', 'terlihat', 'termasuk', 'ternyata', 'tersampaikan', 'tersebut', 'tersebutlah', 'tertentu', 'tertuju', 'terus', 'terutama', 'tetap', 'tiap', 'tiba', 'tiba-tiba', 'tidakkah', 'tidaklah', 'tiga', 'tuju', 'tunjuk', 'turut', 'tutur', 'tuturnya', 'u', 'ucap', 'ucapnya', 'ujar', 'ujarnya', 'umumnya', 'ungkap', 'ungkapnya', 'usah', 'usai', 'v', 'w', 'waduh', 'wah', 'wahai', 'waktunya', 'walaupun', 'wong', 'x', 'y', 'yakin', 'z']

# import library pendukung
import string
import re
import nltk
nltk.download('punkt')
from nltk.tokenize import word_tokenize
from nltk.util import ngrams
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory, StopWordRemover, ArrayDictionary

# inisialisasi fungsi yang dibutuhkan dari library
factory = StemmerFactory()
stemmer = factory.create_stemmer()
stop_factory = StopWordRemoverFactory().get_stop_words()
data = stop_factory + more_stopword
dictionary = ArrayDictionary(data)
stopword = StopWordRemover(dictionary)

# fungsi filtering
def filtering(text):
  text = text.lower()
  text = re.sub(r'\d+', '', text)
  text = text.translate(text.maketrans('','',string.punctuation))
  text = text.strip()
  text = re.sub('\s+',' ',text)
  text = stopword.remove(text)
  text = stemmer.stem(text)
  return text

# fungsi sinonim recognition
def synonim_recognition(jwb, kj):
  arr_jwb = jwb.split(' ')
  arr_kj = kj.split(' ')
  new_jwb = []
  for i in arr_kj:
    for j in arr_jwb:
      if j == i:
        if len(new_jwb) > 0 and new_jwb[-1] != j:
          new_jwb.append(j)
        elif len(new_jwb) == 0:
          new_jwb.append(j)
      else:
        synonims = get_sinonim(j)
        if i in synonims:
          if len(new_jwb) > 0 and new_jwb[-1] != i:
            new_jwb.append(i)
          elif len(new_jwb) == 0:
            new_jwb.append(i)

  return ' '.join([str(x) for x in new_jwb])

# fungsi membuat kgram
def create_kgram(text, n):
  n_grams = ngrams(word_tokenize(text), n)
  return [' '.join(grams) for grams in n_grams]

# fungsi mendapatkan hasil kgram
def get_kgram_result(text):
  kgram_result = create_kgram(text, 1)
  return list(dict.fromkeys(kgram_result))

# fungsi rolling hash untuk mendapatkan nilai hash
def rolling_hash(pattern, Q):
  total_hash = []
  b = 5
  for i in pattern:
    el_hash = 0
    el_arr = i.split(' ')
    for j in el_arr:
      hash = 0
      m = len(j)
      for k in range(m):
        char_code = ord(j[k])
        hash += (char_code * (b ** (m - k - 1)))
      el_hash += (hash % Q)
    total_hash.append(el_hash)
  return total_hash

# fungsi dice similiarity untuk mendapatkan skor kemiripin
def dice_similiarity(first_doc, sec_doc):
  total_first_doc = len(first_doc)
  total_sec_doc = len(sec_doc)

  if total_first_doc == 0 or total_sec_doc == 0:
    return 0

  same_hash = set(first_doc).intersection(set(sec_doc))
  total_same_hash = len(same_hash)
  similiarity = (2 * total_same_hash) / (total_first_doc + total_sec_doc)
  return round(similiarity, 2)

# fungsi get sinonim untuk mendapatkan sinonim kata
def get_sinonim(word):
        if word in mydict.keys():
                return mydict[word]['sinonim']
        else:
                return []

# filtering jawaban siswa
fl1 = filtering(sys.argv[1])
# filtering kunci jawaban guru
fl2 = filtering(sys.argv[2])
# sinonim recognition jawaban siswa dengan kunci jawaban guru
syn1 = synonim_recognition(fl1, fl2)
# mendapatkan kgram dari hasil sinonim recognition jawaban siswa
kg1 = get_kgram_result(syn1)
# mendapatkan kgram dari filtering kunci jawaban guru
kg2 = get_kgram_result(fl2)
# hashing kgram jawaban siswa
rh1 = rolling_hash(kg1, 100007)
# hashing kgram kunci jawaban guru
rh2 = rolling_hash(kg2, 100007)
# mendapatkan similiarity
res1 = dice_similiarity(rh1, rh2)

print(res1)