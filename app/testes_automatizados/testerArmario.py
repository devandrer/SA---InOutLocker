from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

options = webdriver.ChromeOptions()
driver = webdriver.Chrome(options=options)

#executara o projeto na tela inicial do login
driver.get("http://localhost:8080/inoutlocker/app/armario.php")

time.sleep(4)

#vai acessar o sistema
novoarmario_button = driver.find_element(By.CSS_SELECTOR,"button[data-toggle='modal']")
novoarmario_button.click()

print(novoarmario_button)


modal= WebDriverWait(driver,5).until(
    EC.visibility_of_element_located((By.ID, "novoArmarioModal"))
)

# Preenche o campo Nome
local_input = modal.find_element(By.NAME, "local")
local_input.send_keys("Bloco G")

# Preenche o campo CPF
select_empresa = Select(modal.find_element(By.NAME, "nEmpresa"))
select_empresa.select_by_index(1)

# Preenche o campo usuario ativo
ativo_checkbox = modal.find_element(By.NAME, "nAtivo")
ativo_checkbox.click()

#vai aguardar o resultado por 8 seg.
time.sleep(8)

#fecha o navegador
driver.quit()