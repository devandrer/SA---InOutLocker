from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

options = webdriver.ChromeOptions()
driver = webdriver.Chrome(options=options)

#executara o projeto na tela inicial do login
driver.get("http://localhost:8080/inoutlocker/app/index.php")

time.sleep(1)

#Tela de Login ------------------

#preenche o campo login com o e-mail já cadastrado
email_input = driver.find_element(By.NAME, "nNome") 
email_input.send_keys("j@teste.com")


#preenche o campo senha já cadastrada
senha_input = driver.find_element(By.NAME, "nSenha")
senha_input.send_keys("123")

#vai acessar o sistema
submit_button = driver.find_element(By.CSS_SELECTOR, "button[type='submit']")
submit_button.click()

#vai aguardar o resultado por 8 seg.
time.sleep(2)

# Dashboard ------------------

admin_link = driver.find_element(By.ID,"adminLink")
admin_link.click()

time.sleep(1)

porta_link = driver.find_element(By.ID,"portaLink")
porta_link.click()

time.sleep(2)

#Tela de armarios --------------------

# #vai acessar o sistema
novoarmario_button = driver.find_element(By.CSS_SELECTOR,"button[data-target='#novaPortaModal']")
novoarmario_button.click()

modal= WebDriverWait(driver,5).until(
    EC.visibility_of_element_located((By.ID, "novaPortaModal"))
)

# Preenche o campo Nome
nr_local_input = modal.find_element(By.ID, "iNrPorta")
nr_local_input.send_keys("Z001")

# Preenche o campo CPF
select_armario = Select(modal.find_element(By.ID, "iArmario"))
select_armario.select_by_index(1)

# Preenche o campo CPF
select_status = Select(modal.find_element(By.ID, "iStatus"))
select_status.select_by_index(1)

# # Preenche o campo usuario ativo
# ativo_checkbox = modal.find_element(By.NAME, "nAtivo")
# ativo_checkbox.click()

btn_submit = modal.find_element(By.CSS_SELECTOR,"button[value='modal_salvar']")
btn_submit.click()

#vai aguardar o resultado por 8 seg.
time.sleep(3)

#fecha o navegador
driver.quit()