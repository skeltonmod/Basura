package controller;

import javafx.beans.value.ChangeListener;
import javafx.beans.value.ObservableValue;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.control.cell.TreeItemPropertyValueFactory;
import javafx.stage.Stage;
import model.CustomerTableModel;

import java.net.URL;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import java.util.ResourceBundle;

public class AddCustomerController implements Initializable {
    List<TreeItem<CustomerTableModel>> treeItemList = new ArrayList<>();
    List<TreeItem<CustomerTableModel>> emails = new ArrayList<>();

    @FXML
    TreeTableView<CustomerTableModel> table;
    @FXML
    TreeTableColumn<CustomerTableModel,String> col_id;
    @FXML
    TreeTableColumn<CustomerTableModel,String> col_accountNum;
    @FXML
    TreeTableColumn<CustomerTableModel,String> col_fname;
    @FXML
    TreeTableColumn<CustomerTableModel,String> col_lname;
    @FXML
    Button btn_addpeople;
    @FXML
    public void add_to_inventory(){
        btn_addpeople.setOnAction(new EventHandler<ActionEvent>() {
            @Override
            public void handle(ActionEvent actionEvent) {
                try{
                    Parent root = FXMLLoader.load(getClass().getResource("../view/FXML/addCustomerModal.fxml"));
                    Stage stage = new Stage();
                    stage.setTitle("Human Resource");

                    stage.setScene(new Scene(root));
                    stage.show();

                }catch(Exception ex){
                    System.out.println(ex.toString());
                }

            }
        });

    }
    public void getTableData(){
        col_id.setCellValueFactory(new TreeItemPropertyValueFactory<>("id"));
        col_accountNum.setCellValueFactory(new TreeItemPropertyValueFactory<>("accountName"));
        col_fname.setCellValueFactory(new TreeItemPropertyValueFactory<>("firstname"));
        col_lname.setCellValueFactory(new TreeItemPropertyValueFactory<>("lastname"));
        try {
            DatabaseController dbconn = new DatabaseController();
            ResultSet res = dbconn.DBConnection().createStatement().executeQuery("SELECT * FROM customer");
            TreeItem<CustomerTableModel> accounts = new TreeItem<>(new CustomerTableModel("CUSTOMER","","",""));
            while(res.next()){
                treeItemList.add(new TreeItem<>(new CustomerTableModel(String.valueOf(res.getInt("id")),
                        res.getString("accountName"),res.getString("fname"),res.getString("lname"))));
                emails.add(new TreeItem<>(new CustomerTableModel("",
                        "",res.getString("email"),"")));
                accounts.getChildren().clear();
            }
            for(int i = 0; i<treeItemList.size();++i){

                TreeItem<CustomerTableModel> customer = treeItemList.get(i);
                accounts.getChildren().add(customer);
                customer.getChildren().add(emails.get(i));

            }
            table.getSelectionModel().selectedItemProperty().addListener(new ChangeListener<TreeItem<CustomerTableModel>>() {
                @Override
                public void changed(ObservableValue<? extends TreeItem<CustomerTableModel>> observableValue,
                                    TreeItem<CustomerTableModel> customerTableModelTreeItem, TreeItem<CustomerTableModel> t1) {
                    //prevent the user from clicking the parent entry
                    if(!t1.getValue().getId().equals("CUSTOMER")){
                        try {
                            FXMLLoader loader = new FXMLLoader();
                            loader.setLocation(getClass().getResource("../view/FXML/addCustomerModal.fxml"));
                            Parent parent = loader.load();
                            Scene scene = new Scene(parent);
                            //WTF!
                            CustomerModalController mc = loader.getController();
                            mc.editCustomer(t1.getValue().getId());
                            Stage window = new Stage();
                            window.setScene(scene);
                            window.show();
                        } catch (Exception ex) {
                            ex.printStackTrace();
                        }
                    }
                }
            });
            table.setRoot(accounts);
        }catch (SQLException ex){
            ex.printStackTrace();
        }

    }

    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        getTableData();
    }

}
