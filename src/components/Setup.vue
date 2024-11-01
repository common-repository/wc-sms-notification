<template>
  <div>
    <div class="card" style="max-width: 100%">
      <h2 class="title">SMS SERVICE SETTINGS</h2>
      <table class="form-table" role="presentation">
        <tbody>
          <tr>
            <th scope="row">
              <label for="sms_service">SMS service</label>
            </th>
            <td>
              <select
                v-model="form.sms_service"
                id="sms_service"
                style="width: 100%"
                @change="setData"
              >
                <option
                  v-for="(provider, index) in providers"
                  :key="'provider-option-' + index"
                  :value="provider.name"
                >
                  {{ provider.label }}
                </option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card" style="max-width: 100%">
      <h2 class="title">API SETTINGS</h2>
      <table class="form-table" role="presentation">
        <tbody v-if="fields[form.sms_service].settings != undefined">
          <tr
            v-for="(field, index) in fields[form.sms_service].settings"
            :key="'field-' + index"
          >
            <th scope="row">
              <label :for="field.name">{{ field.label }}</label>
            </th>
            <td>
              <input
                :type="field.type"
                :id="field.name"
                v-model="form[field.name]"
                :placeholder="field.placeholder"
                class="regular-text"
                :value="field.value"
              />
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card" style="max-width: 100%">
      <h2 class="title">SENDING SETTINGS</h2>
      <table class="form-table" role="presentation">
        <tbody>
          <tr
            v-for="(field, index) in fields[form.sms_service].sending"
            :key="'sfield-' + index"
          >
            <th scope="row">
              <label :for="field.name">{{ field.label }}</label>
            </th>
            <td>
              <input
                :type="field.type"
                :id="field.name"
                v-model="form[field.name]"
                :placeholder="field.placeholder"
                class="regular-text"
                :value="field.value"
              />
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <p class="submit">
      <button @click="saveData" type="button" class="button button-primary">
        Save Changes
      </button>
    </p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        sms_service: "twilio",
      },
      providers: [],
      fields: {
        twilio: {
          settings: {},
          sending: {},
        },
      },
    };
  },
  methods: {
    getData() {
      let formData = {
        action: "sms_setup_form_data",
      };
      let root = this;

      axios
        .post(sms_helper_obj.ajax_url, Qs.stringify(formData))
        .then((response) => {
          root.providers = response.data.provider;
          root.fields = response.data.fields;
          root.form.sms_service = response.data.sms_service;
          root.setData();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    setData() {
      for (
        let index = 0;
        index < this.fields[this.form.sms_service].settings.length;
        index++
      ) {
        const element = this.fields[this.form.sms_service].settings[index];

        if (element.value != null) {
          this.form[element.name] = element.value;
        }
      }

      for (
        let index = 0;
        index < this.fields[this.form.sms_service].sending.length;
        index++
      ) {
        const element = this.fields[this.form.sms_service].sending[index];

        if (element.value != null) {
          this.form[element.name] = element.value;
        }
      }
    },
    saveData() {
      const verify = this.verifyFields();
      if (verify.result === "failed") {
        this.$toast.open({
          message: verify.msg,
          type: "error",
        });
        return false;
      }

      let formData = {
        action: "sms_setup_form",
        nonce: sms_helper_obj.nonce,
        data: this.form,
      };

      axios
        .post(sms_helper_obj.ajax_url, Qs.stringify(formData))
        .then((response) => {
          this.$toast.open({
            message: response.data.msg,
            type: response.data.type,
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    verifyFields() {
      for (
        let index = 0;
        index < this.fields[this.form.sms_service].settings.length;
        index++
      ) {
        const element = this.fields[this.form.sms_service].settings[index];
        if (element.required === true) {
          if (
            this.form[element.name] == null ||
            this.form[element.name] == undefined ||
            this.form[element.name] == ""
          ) {
            return {
              result: "failed",
              msg: element.label + " is required !!",
            };
          }
        }
      }
      for (
        let index = 0;
        index < this.fields[this.form.sms_service].sending.length;
        index++
      ) {
        const element = this.fields[this.form.sms_service].sending[index];
        if (element.required === true) {
          if (
            this.form[element.name] == null ||
            this.form[element.name] == undefined ||
            this.form[element.name] == ""
          ) {
            return {
              result: "failed",
              msg: element.label + " is required !!",
            };
          }
        }
      }
      return {
        result: "success",
      };
    },
  },
  created() {
    this.getData();
  },
};
</script>