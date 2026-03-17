// ===== Main.java ===== import javafx.application.Application; import javafx.fxml.FXMLLoader; import javafx.scene.Scene; import javafx.stage.Stage;

public class Main extends Application { @Override public void start(Stage stage) throws Exception { FXMLLoader loader = new FXMLLoader(getClass().getResource("form.fxml")); Scene scene = new Scene(loader.load()); stage.setTitle("Formularz"); stage.setScene(scene); stage.show(); }

public static void main(String[] args) {
    launch();
}

}

// ===== Controller.java ===== import javafx.fxml.FXML; import javafx.scene.control.*;

public class Controller {

@FXML private TextField nameField;
@FXML private TextField emailField;
@FXML private TextField postalField;
@FXML private PasswordField passwordField;

@FXML private RadioButton maleRadio;
@FXML private RadioButton femaleRadio;

@FXML private CheckBox sportCheck;
@FXML private CheckBox musicCheck;

@FXML private Spinner<Integer> ageSpinner;
@FXML private ChoiceBox<String> countryChoice;
@FXML private Slider levelSlider;

@FXML
public void initialize() {
    ageSpinner.setValueFactory(new SpinnerValueFactory.IntegerSpinnerValueFactory(1, 100, 18));
    countryChoice.getItems().addAll("Polska", "Niemcy", "USA");
}

@FXML
private void handleSubmit() {
    String name = nameField.getText();
    String email = emailField.getText();
    String postal = postalField.getText();

    if (name.isEmpty() || email.isEmpty() || postal.isEmpty()) {
        showAlert("Błąd", "Wypełnij wszystkie pola!");
        return;
    }

    if (!name.matches("[A-Z][a-z]+")) {
        showAlert("Błąd", "Imię musi zaczynać się wielką literą!");
        return;
    }

    if (!email.contains("@")) {
        showAlert("Błąd", "Email musi zawierać @!");
        return;
    }

    if (!postal.matches("\\d{2}-\\d{3}")) {
        showAlert("Błąd", "Kod pocztowy: xx-xxx");
        return;
    }

    if (!maleRadio.isSelected() && !femaleRadio.isSelected()) {
        showAlert("Błąd", "Wybierz płeć!");
        return;
    }

    showAlert("Sukces", "Dane poprawne!");
}

private void showAlert(String title, String msg) {
    Alert alert = new Alert(Alert.AlertType.INFORMATION);
    alert.setTitle(title);
    alert.setContentText(msg);
    alert.showAndWait();
}

}

// ===== form.fxml =====

<?xml version="1.0" encoding="UTF-8"?><?import javafx.scene.control.*?><?import javafx.scene.layout.*?><?import javafx.scene.image.ImageView?><AnchorPane prefWidth="400" prefHeight="500" xmlns:fx="http://javafx.com/fxml" fx:controller="Controller"><children>
    <VBox spacing="10" layoutX="20" layoutY="20">

        <Label text="Imię:" />
        <TextField fx:id="nameField" />

        <Label text="Email:" />
        <TextField fx:id="emailField" />

        <Label text="Kod pocztowy:" />
        <TextField fx:id="postalField" />

        <Label text="Hasło:" />
        <PasswordField fx:id="passwordField" />

        <Label text="Płeć:" />
        <HBox>
            <RadioButton text="M" fx:id="maleRadio" />
            <RadioButton text="K" fx:id="femaleRadio" />
        </HBox>

        <Label text="Zainteresowania:" />
        <HBox>
            <CheckBox text="Sport" fx:id="sportCheck" />
            <CheckBox text="Muzyka" fx:id="musicCheck" />
        </HBox>

        <Label text="Wiek:" />
        <Spinner fx:id="ageSpinner" />

        <Label text="Kraj:" />
        <ChoiceBox fx:id="countryChoice" />

        <Label text="Poziom:" />
        <Slider fx:id="levelSlider" min="0" max="100" />

        <Button text="Wyślij" onAction="#handleSubmit" />

        <ImageView fitHeight="100" fitWidth="100" />

    </VBox>
</children>

</AnchorPane>