from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

options = webdriver.ChromeOptions()
driver = webdriver.Chrome(options=options)

#executara o projeto na tela inicial do login
driver.get("http://localhost:8080/inoutlocker/app/empresa.php")

time.sleep(4)

#vai acessar o sistema
novaempresa_button = driver.find_element(By.CSS_SELECTOR,"button[data-toggle='modal']")
novaempresa_button.click()

modal= WebDriverWait(driver,10).until(
    EC.visibility_of_element_located((By.ID, "novaEmpresaModal"))
)

# Preenche o campo Nome
razao_input = modal.find_element(By.NAME, "nRazao")
razao_input.send_keys("Servico Nacional de Aprendizagem Industrial de Blumenau")

# Preenche o campo CPF
cnpj_input = modal.find_element(By.NAME, "nCnpj")
cnpj_input.send_keys("03774688002107")

# Preenche o campo cep
cep_input = modal.find_element(By.NAME, "CEP")
cep_input.send_keys("89012-001")

# Preenche o campo usuario ativo
ativo_checkbox = modal.find_element(By.NAME, "nAtivo")
ativo_checkbox.click()

#vai aguardar o resultado por 8 seg.
time.sleep(4)   

# Preenche o campo numero do endereco
numero_input = modal.find_element(By.NAME, "Numero")
numero_input.send_keys("1147")

#vai acessar o sistema
submit_button = modal.find_element(By.CSS_SELECTOR, "button[type='submit']")
submit_button.click()

#vai aguardar o resultado por 8 seg.
time.sleep(8)

#fecha o navegador
driver.quit()