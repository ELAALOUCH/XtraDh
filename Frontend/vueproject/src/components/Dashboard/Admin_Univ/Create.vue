<template>
  <div>3
  data() {
    return {
      showModal: false,
      formData: {
        name: '',
        email: ''
      }
    };
  },
  methods: {
    closeModal() {
      this.showModal = false;
    },
    submitForm() {
      // Perform form submission logic here
      console.log(this.formData);
      // You can also close the modal after form submission
      this.closeModal();
    },
    deleteFormData() {
      this.formData.name = '';
      this.formData.email = '';
    }
  }
};
</script>

<style>
.modal {
  z-index: 9999;
}

.modal-overlay {
  z-index: -1;
}

.close {
  color: #aaa;
  cursor: pointer;
}

.close:hover {
  color: #000;
}

.avatar {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background-color: #f44336;
  color: white;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 14px;
}
</style>