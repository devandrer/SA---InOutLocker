from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

options = webdriver.ChromeOptions()
driver = webdriver.Chrome(options=options)

#executara o projeto na tela inicial do login
driver.get("http://localhost:8080/inoutlocker/app/usuarios.php")

time.sleep(4)

#vai acessar o sistema
novousuario_button = driver.find_element(By.CSS_SELECTOR,"button[data-toggle='modal']")
novousuario_button.click()

modal= WebDriverWait(driver,10).until(
    EC.visibility_of_element_located((By.ID, "novoUsuarioModal"))
)

# Preenche o campo Nome
nome_input = modal.find_element(By.NAME, "nNome")
nome_input.send_keys("Joao")

# Preenche o campo CPF
cpf_input = modal.find_element(By.NAME, "nCpf")
cpf_input.send_keys("12345678912")

#preenche o campo tipo usuario
select_tipo = Select(modal.find_element(By.NAME, "nTipoUsuario"))
select_tipo.select_by_index(1)

select_empresa = Select(modal.find_element(By.NAME, "nEmpresa"))
select_empresa.select_by_index(1)

#preenche o campo login com o e-mail
email_input = modal.find_element(By.NAME, "nLogin") 
email_input.send_keys("jo@teste.com")

#preenche o campo senha
senha_input = modal.find_element(By.NAME, "nSenha")
senha_input.send_keys("123")

# Preenche o campo matricula
matricula_input = modal.find_element(By.NAME, "nMatricula")
matricula_input.send_keys("205206")

# Preenche o campo usuario ativo
ativo_checkbox = modal.find_element(By.NAME, "nAtivo")
ativo_checkbox.click()

# Preenche o campo cep
cep_input = modal.find_element(By.NAME, "CEP")
cep_input.send_keys("89231-300")

# Preenche o campo numero do endereco
numero_input = modal.find_element(By.NAME, "Numero")
numero_input.send_keys("789")

#vai acessar o sistema
submit_button = modal.find_element(By.CSS_SELECTOR, "button[type='submit']")
submit_button.click()

#vai aguardar o resultado por 8 seg.
time.sleep(8)

#fecha o navegador
driver.quit()