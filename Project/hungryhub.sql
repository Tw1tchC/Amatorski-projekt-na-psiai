package com.example.demo;

import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Spinner;
import javafx.scene.control.SpinnerValueFactory;
import javafx.scene.control.TextField;

public class HelloController {

    @FXML
    private TextField nameField;

    @FXML
    private TextField surnameField;

    @FXML
    private TextField emailField;

    @FXML
    private Spinner<Integer> ageSpinner;

    @FXML
    public void initialize() {
        SpinnerValueFactory<Integer> valueFactory =
                new SpinnerValueFactory.IntegerSpinnerValueFactory(1, 120, 18);
        ageSpinner.setValueFactory(valueFactory);
    }

    @FXML
    private void handleSubmit() {

        String name = nameField.getText();
        String surname = surnameField.getText();
        String email = emailField.getText();
        int age = ageSpinner.getValue();

        // Regex
        String nameRegex = "^[A-ZŁŚŻŹĆŃ][a-zA-ZłśżźćńąęóĄĘÓ]+$";
        String emailRegex = "^[A-Za-z0-9+_.-]+@[A-Za-z0-9.-]+$";

        // Walidacja imienia
        if (!name.matches(nameRegex)) {
            showError("Imię musi zaczynać się wielką literą i nie może zawierać cyfr!");
            return;
        }

        // Walidacja nazwiska
        if (!surname.matches(nameRegex)) {
            showError("Nazwisko musi zaczynać się wielką literą i nie może zawierać cyfr!");
            return;
        }

        // Walidacja email
        if (!email.matches(emailRegex)) {
            showError("Niepoprawny adres email!");
            return;
        }

        // Jeśli wszystko poprawne
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle("Dane użytkownika");
        alert.setHeaderText("Wprowadzone dane:");
        alert.setContentText(
                "Imię: " + name +
                "\nNazwisko: " + surname +
                "\nEmail: " + email +
                "\nWiek: " + age
        );
        alert.showAndWait();
    }

    private void showError(String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle("Błąd");
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
}