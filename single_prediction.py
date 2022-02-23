from change2_func import *
import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
from sklearn import linear_model
import os

#if os.path.isfile('predict.csv'):#
#	os.remove("predict.csv")

values = []
df = pd.read_csv('predict.csv')
reg = linear_model.LinearRegression()
reg.fit(df[['Month']], df.Incidents)
rows = len(df.index) + 1
predicted_value = reg.predict([[rows]])
values.append(predicted_value)

df2 = pd.DataFrame([])
df2['Predicted'] = predicted_value
print (str(predicted_value[0]))
#df2.to_csv("single_predicted.csv", index=False)

del df
del df2
reg = ""
predicted_value = ""

